<?php

namespace App\Controller;

use App\Model\EventManager;
use App\Controller\AbstractController;

class EventController extends AbstractController
{
  
    private const MAX_LENGTH_TITLE = 100;
    private const MAX_LENGTH_DESCRIPTION = 200;
    private const MAX_PICTURE_SIZE = 200000;

    public function indexAdmin(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll('title');

        return $this->twig->render('/Event/index.html.twig', ['events' => $events]);
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
        if (!isset($activity['description']) || strlen($activity['description']) > self::MAX_LENGTH_DESCRIPTION) {
            $errors[] = 'La description ne doit pas faire plus de ' . self::MAX_LENGTH_DESCRIPTION . ' caractères !';
        }

        return $errors;
    }

    public function add()
    {

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = array_map('trim', $_POST);
            $errors = $this->getFormErrors($event, $errors);

            // creer le fichier image pour le mettre dans le folder upload (ce folder ne sera pas versioné)
            $targetDir = "assets/upload/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
            $allowedExtension = ['jpg','png','webp'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit être de type ' . implode(", ", $allowedExtension) . ' !';
            }
            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                $errors[] = 'L\'image doit avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000 . ' Ko !';
            }

            if (empty($errors)) {
                // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $eventManager = new EventManager();
                    $eventManager->insert($event, $targetFile);
                    header('Location: /event/indexAdmin');
                } else {
                    $errors[] = 'Le fichier image n\'a pu être ajouté !';
                }
            }
        }
        return $this->twig->render('Event/add.html.twig', ['errors' => $errors]);
    }
}
