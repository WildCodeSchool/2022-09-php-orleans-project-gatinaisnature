<?php

namespace App\Controller;

use App\Model\LandscapeManager;
use App\Controller\AbstractController;

class LandscapeController extends AbstractController
{
    private const MAX_LENGTH_TITLE = 100;
    private const MAX_LENGTH_DESCRIPTION = 200;
    private const MAX_PICTURE_SIZE = 1000000;

    /**
     * Display home page
     */
    public function index(): string
    {
        $landscapeManager = new LandscapeManager();
        $landscapes = $landscapeManager->selectAll();

        return $this->twig->render('Landscape/landscape.html.twig', [
            'landscapes' => $landscapes,
        ]);
    }

    public function indexLandscapeAdmin(): string
    {
        $landscapeManager = new LandscapeManager();
        $landscapes = $landscapeManager->selectAll('title');

        return $this->twig->render('Landscape/indexAdmin.html.twig', ['landscapes' => $landscapes]);
    }

    public function edit(int $id)
    {
        $errors = [];
        $landscapeManager = new LandscapeManager();
        $landscape = $landscapeManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $landscape = array_map('trim', $_POST);
            $errors = $this->getFormErrors($landscape, $errors);

            // create the image file to put it in the upload folder (without versioning)
            $targetDir = "uploads/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $uploadFinalName = uniqid($imageFileName) . '.' . $imageFileType;
            $targetFile = $targetDir . $uploadFinalName;
            $allowedExtension = ['jpg','png','webp'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit être de type ' . implode(", ", $allowedExtension) . ' !';
            }
            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                $errors[] = 'L\'image doit avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000000 . ' Mo !';
            }

            if (empty($errors)) {
            // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $landscapeManager = new LandscapeManager();
                    $landscapeManager->update($landscape, $uploadFinalName);
                    header('Location: /admin/paysages/index');
                } else {
                    $errors[] = 'Le fichier image n\'a pu être ajouté !';
                }
            }
        }
        return $this->twig->render('Landscape/edit.html.twig', ['landscape' => $landscape, 'errors' => $errors]);
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
            $targetDir = "uploads/";
            $imageFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $imageFileName = pathinfo($_FILES['picture']['name'])['filename'];
            $uploadFinalName = uniqid($imageFileName) . '.' . $imageFileType;
            $targetFile = $targetDir . $uploadFinalName;
            $allowedExtension = ['jpg','png','jpeg','webp'];
            if (!in_array($imageFileType, $allowedExtension)) {
                $errors[] = 'L\'image doit être de type ' . implode(", ", $allowedExtension) . ' !';
            }
            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE) {
                $errors[] = 'L\'image doit avoir une taille maximum de ' . self::MAX_PICTURE_SIZE / 1000000 . ' Mo !';
            }

            if (empty($errors)) {
                // move image to upload folder
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $landscapeManager = new LandscapeManager();
                    $landscapeManager->insert($landscape['title'], $landscape['description'], $uploadFinalName);
                    header('Location: /admin/paysages/index');
                } else {
                    $errors[] = 'Le fichier image n\'a pu être ajouté !';
                }
            }
        }
        return $this->twig->render('Landscape/add.html.twig', ['errors' => $errors]);
    }
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $landscapeManager = new LandscapeManager();
            $landscapeManager->delete((int)$id);

            header('Location: /admin/paysages/index');
        }
    }
}
