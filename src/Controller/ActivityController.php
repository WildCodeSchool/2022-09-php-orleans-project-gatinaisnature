<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\EventManager;
use App\Controller\AbstractController;

class ActivityController extends AbstractController
{
    /**
     * Display home page
     */

    private const MAX_LENGTH_TITLE = 100;
    private const MAX_LENGTH_DESCRIPTION = 200;
    private const MAX_PICTURE_SIZE = 200000;

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectEventsDateDetails();
        $activityManager = new ActivityManager();
        $activities = [];
        $activities = $activityManager->selectAll();


        return $this->twig->render('Activity/activity.html.twig', ['events' => $events, 'activities' => $activities]);
    }


    public function getFormErrors(array $activity, array $errors): array
    {
        if (!isset($activity['title']) || empty($activity['title'])) {
            $errors[] = 'Le titre doit être complété';
        }
        if (!isset($activity['title']) || strlen($activity['title']) > self::MAX_LENGTH_TITLE) {
            $errors[] = 'Le titre ne doit pas faire plus de ' . self::MAX_LENGTH_TITLE . ' caracteres';
        }
        if (empty($activity['description'])) {
            $errors[] = 'La description doit être complété';
        }
        if (!isset($activity['description']) || strlen($activity['description']) > self::MAX_LENGTH_DESCRIPTION) {
            $errors[] = 'La description ne doit pas faire plus de ' . self::MAX_LENGTH_DESCRIPTION . ' caracteres';
        }

        return $errors;
    }

    public function show(int $id)
    {
        $activityManager = new ActivityManager();
        $activity = $activityManager->selectOneById($id);

        return $this->twig->render('Activity/show.html.twig', ['activity' => $activity]);
    }

    public function add()
    {

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity = array_map('trim', $_POST);
            $errors = $this->getFormErrors($activity, $errors);

            // creer le fichier image pour le mettre dans le folder upload (ce folder ne sera pas versioné)
            $targetDir = "./assets/upload/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
            $allowedExtension = ['jpg','png'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit etre de type ' . implode(", ", $allowedExtension);
            }
            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                $errors[] = 'L\'image doit etre avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000 . ' Ko';
            }

            if (empty($errors)) {
                // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $activityManager = new ActivityManager();
                    $activityManager->insert($activity['title'], $activity['description'], $targetFile);
                    header('Location: /activity');
                } else {
                    $errors[] = 'Le fichier image n\'a pu etre ajouté';
                }
            }
        }
        return $this->twig->render('Activity/add.html.twig', ['errors' => $errors]);
    }

    public function edit(int $id)
    {
        $errors = [];
        $activityManager = new ActivityManager();
        $activity = $activityManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity = array_map('trim', $_POST);
            $errors = $this->getFormErrors($activity, $errors);

            // creer le fichier image pour le mettre dans le folder upload (ce folder ne sera pas versioné)
            $targetFile = '';
            if ($_FILES['picture']['name'] > 0) {
                $targetDir = "./assets/upload/";
                $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
                $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
                $allowedExtension = ['jpg','png'];
                if (!in_array($imageFileType, $allowedExtension)) {
                    $errors[] = 'L\'image doit etre de type ' . implode(", ", $allowedExtension);
                }
                if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                    $errors[] = 'L\'image doit etre avoir une taille maxi de ' . self::MAX_PICTURE_SIZE / 1000 . ' Ko';
                }
            }
            if (empty($errors)) {
                // move image to upload folder
                if ($_FILES['picture']['name'] > 0) {
                    if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                        $activityManager->update($activity, $targetFile);
                        header('Location: /activity');
                    } else {
                        $errors[] = 'Le fichier image n\'a pu etre ajouté';
                    }
                } else {
                    $activityManager->update($activity, null);
                    header('Location: /activity');
                }
            }
        }
        return $this->twig->render('Activity/edit.html.twig', ['activity' => $activity, 'errors' => $errors]);
    }
}
