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

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectEventsDateDetails();
        $activityManager = new ActivityManager();
        $activities = [];
        $activities = $activityManager->selectAll();


        return $this->twig->render('Activity/activity.html.twig', ['events' => $events, 'activities' => $activities]);
    }


    public function getFormErrors(array $inputs, array $errors): array
    {
        if (!isset($inputs['title']) || empty($inputs['title'])) {
            $errors[] = 'Le titre doit être complété';
        }
        if (!isset($inputs['title']) || strlen($inputs['title']) > 100) {
            $errors[] = 'Le titre ne doit pas faire plus de 100 caracteres';
        }
        if (empty($inputs['description'])) {
            $errors[] = 'La description doit être complété';
        }
        if (!isset($inputs['description']) || strlen($inputs['description']) > 200) {
            $errors[] = 'La description ne doit pas faire plus de 200 caracteres';
        }

        return $errors;
    }

    public function add()
    {

        $errors = [];
        $messages = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputs = array_map('trim', $_POST);
            $errors = $this->getFormErrors($inputs, $errors);

            // creer le fichier image pour le mettre dans le folder upload (ce folder ne sera pas versioné)
            $targetDir = "./assets/upload/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
            //check à rajouter ensuite ici !
            //taille/extension/mettre un unique id pour ne pas ecraser les images.
            $allowedExtension = ['jpg','png'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit etre de type jpg ou png';
            }
            if ($_FILES['picture']['size'] > 200000) {
                $errors[] = 'L\'image doit etre d\'une taille maximum de 200 Ko';
            }

            if (empty($errors)) {
                // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $messages[] = 'L\'ajout est bien efféctué';
                    $activityManager = new ActivityManager();
                    $activityManager->insert($inputs['title'], $inputs['description'], $targetFile);
                } else {
                    $errors[] = 'Le fichier image n\'a pu etre ajouté';
                }
            } else {
                $messages[] = 'L\'ajout n\'est pas efféctué, voici la liste des erreurs';
            }
        }
        return $this->twig->render('Activity/add.html.twig', ['errors' => $errors, 'messages' => $messages]);
    }
}
