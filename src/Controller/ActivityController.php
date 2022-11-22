<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\EventManager;
use App\Controller\AbstractController;

class ActivityController extends AbstractController
{
    private const MAX_LENGTH_TITLE = 100;
    private const MAX_PICTURE_SIZE = 1000000;

    /**
     * Display home page
     */

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectEventsDateDetails();
        $activityManager = new ActivityManager();
        $activities = [];
        $activities = $activityManager->selectAll();

        return $this->twig->render('Activity/activity.html.twig', ['events' => $events, 'activities' => $activities]);
    }

        /**
     * List items
     */
    public function indexAdmin(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAll('title');

        return $this->twig->render('Activity/index.html.twig', ['activities' => $activities]);
    }
    public function getFormErrors(array $activity, array $errors): array
    {
        if (!isset($activity['title']) || empty($activity['title'])) {
            $errors[] = 'Le titre doit être complété !';
        }
        if (!isset($activity['title']) || strlen($activity['title']) > self::MAX_LENGTH_TITLE) {
            $errors[] = 'Le titre ne doit pas faire plus de ' . self::MAX_LENGTH_TITLE . ' caractères !';
        }
        if (empty($activity['description'])) {
            $errors[] = 'La description doit être complétée !';
        }
        if (!isset($activity['description']) || empty($activity['description'])) {
            $errors[] = 'La description est requise !';
        }

        return $errors;
    }

    public function add()
    {

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity = array_map('trim', $_POST);
            $errors = $this->getFormErrors($activity, $errors);

            // creer le fichier image pour le mettre dans le folder upload (ce folder ne sera pas versioné)
            $targetDir = "./assets/uploads/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
            $allowedExtension = ['jpg','png'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit être de type ' . implode(", ", $allowedExtension) . ' !';
            }
            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                $errors[] = 'L\'image doit avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000000 . ' Mo !';
            }

            if (empty($errors)) {
                // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $activityManager = new ActivityManager();
                    $activityManager->insert($activity['title'], $activity['description'], $targetFile);
                    header('Location: /activity');
                } else {
                    $errors[] = 'Le fichier image n\'a pu être ajouté !';
                }
            }
        }
        return $this->twig->render('Activity/add.html.twig', ['errors' => $errors]);
    }

        /**
     * Edit a specific activity
     */
    public function edit(int $id)
    {
        $errors = [];
        $activityManager = new ActivityManager();
        $activity = $activityManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activity = array_map('trim', $_POST);
            $errors = $this->getFormErrors($activity, $errors);

            // create the image file to put it in the upload folder (without versioning)
            $targetFile = '';
            if ($_FILES['picture']['name'] > 0) {
                $targetDir = "assets/uploads/";
                $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
                $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
                $allowedExtension = ['jpg','png','jpeg','webp'];
                if (!in_array($imageFileType, $allowedExtension)) {
                    $errors[] = 'L\'image doit être de type ' . implode(", ", $allowedExtension) . ' !';
                }
                if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                    $errors[] = 'L\'image doit avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000000 . 'Mo';
                }
            }
            if (empty($errors)) {
                // move image to upload folder
                if ($_FILES['picture']['size'] > 0) {
                    if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                        $activityManager->update($activity, $targetFile);
                        header('Location: /admin/activites/indexAdmin');
                    } else {
                        $errors[] = 'Le fichier image n\'a pu être ajouté !';
                    }
                }
            }
        }
        return $this->twig->render('Activity/edit.html.twig', ['activity' => $activity, 'errors' => $errors]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $activityManager = new ActivityManager();
            $activityManager->delete((int)$id);

            header('Location:/activity');
        }
    }
}
