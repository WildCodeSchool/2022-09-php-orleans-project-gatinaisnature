<?php

namespace App\Controller;

use App\Model\LandscapeManager;
use App\Controller\AbstractController;

class LandscapeController extends AbstractController
{
    private const MAX_LENGTH_TITLE = 100;
    private const MAX_LENGTH_DESCRIPTION = 200;
    private const MAX_PICTURE_SIZE = 200000;

    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Landscape/landscape.html.twig');
    }

    public function indexLandscapeAdmin(): string
    {
        $landscapeManager = new LandscapeManager();
        $landscapes = $landscapeManager->selectAll('title');

        return $this->twig->render('Landscape/indexAdmin.html.twig', ['landscapes' => $landscapes]);
    }

    public function getFormErrors(array $landscape, array $errors): array
    {
        if (!isset($landscape['title']) || empty($landscape['title'])) {
            $errors[] = 'Le titre doit être complété';
        }
        if (!isset($landscape['title']) || strlen($landscape['title']) > self::MAX_LENGTH_TITLE) {
            $errors[] = 'Le titre ne doit pas faire plus de ' . self::MAX_LENGTH_TITLE . ' caractères';
        }
        if (empty($landscape['description'])) {
            $errors[] = 'La description doit être complétée';
        }
        if (!isset($landscape['description']) || strlen($landscape['description']) > self::MAX_LENGTH_DESCRIPTION) {
            $errors[] = 'La description ne doit pas faire plus de ' . self::MAX_LENGTH_DESCRIPTION . ' caractères';
        }

        return $errors;
    }

    public function add()
    {

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $landscape = array_map('trim', $_POST);
            $errors = $this->getFormErrors($landscape, $errors);

            // creer le fichier image pour le mettre dans le folder upload (ce folder ne sera pas versioné)
            $targetDir = "assets/upload/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $targetFile = $targetDir . uniqid($imageFileName) . '.' . $imageFileType;
            $allowedExtension = ['jpg','png','jpeg','webp'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit être de type ' . implode(", ", $allowedExtension);
            }
            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                $errors[] = 'L\'image doit avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000 . ' Ko';
            }

            if (empty($errors)) {
                // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $landscapeManager = new LandscapeManager();
                    $landscapeManager->insert($landscape['title'], $landscape['description'], $targetFile);
                    header('Location: /admin/paysages/index');
                } else {
                    $errors[] = 'Le fichier image n\'a pu être ajouté';
                }
            }
        }
        return $this->twig->render('Landscape/add.html.twig', ['errors' => $errors]);
    }
}
