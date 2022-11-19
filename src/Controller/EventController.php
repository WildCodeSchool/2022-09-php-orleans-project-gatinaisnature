<?php

namespace App\Controller;

use DateTime;
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

    public function checkDate(string $date, array $errors): void
    {
        new DateTime($date);
        $errorsDate = date_get_last_errors();
        if ($errorsDate['warning_count'] !== 0 || $errorsDate['error_count'] !== 0) {
            $errors[] = 'La date doit être au format AAAA-MM-JJ !';
        }
    }

    public function checkTitle(string $title, array $errors)
    {
        if (empty($title)) {
            $errors[] = 'Le titre doit être complété !';
        }
        if (strlen($title) > self::MAX_LENGTH_TITLE) {
            $errors[] = 'Le titre ne doit pas faire plus de ' . self::MAX_LENGTH_TITLE . ' caractères !';
        }
    }

    public function checkCost(string $cost, array $errors)
    {
        if (empty($cost)) {
            $errors[] = 'Le coût doit être complété !';
        }
        if ($cost < 0) {
            $errors[] = 'Le coût doit être positif !';
        }
    }

    public function getFormErrors(array $event, array $errors): array
    {
        if (!isset($event['title'])) {
            $errors[] = 'Le titre doit être complété !';
        } else {
            $this->checkTitle($event['title'], $errors);
        }
        if (!isset($event['date']) || empty($event['date'])) {
            $errors[] = 'La  date doit être complétée !';
        }
        if (!empty($event['date'])) {
            $this->checkDate($event['date'], $errors);
        }
        if (!isset($event['cost'])) {
            $errors[] = 'Le coût doit être complété !';
        } else {
            $this->checkCost($event['cost'], $errors);
        }
        if (!isset($event['description']) || strlen($event['description']) > self::MAX_LENGTH_DESCRIPTION) {
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
            $targetDir = "assets/uploads/";
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

    public function edit(int $id)
    {
        $errors = [];
        $eventManager = new EventManager();
        $event = $eventManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $event = array_map('trim', $_POST);
            $errors = $this->getFormErrors($event, $errors);

            // create the image file to put it in the upload folder (without versioning)
            $targetDir = "assets/uploads/";
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
                    $eventManager->update($event, $targetFile);
                    header('Location: /event/indexAdmin');
                } else {
                    $errors[] = 'Le fichier image n\'a pu être ajouté !';
                }
            }
        }
        return $this->twig->render('Event/edit.html.twig', ['event' => $event, 'errors' => $errors]);
    }
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $eventManager = new EventManager();
            $eventManager->delete((int)$id);

            header('Location:/event/indexAdmin');
        }
    }
}
