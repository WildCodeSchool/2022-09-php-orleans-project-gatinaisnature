<?php

namespace App\Controller;

use App\Model\CircuitManager;

class CircuitController extends AbstractController
{
    private const MAX_PICTURE_SIZE = 1000000;

    public function index(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = $circuitManager->selectAll();

        return $this->twig->render('Circuits/chooseCircuits.html.twig', ['circuits' => $circuits]);
    }
    
        public function indexCircuitsAdmin(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = $circuitManager->selectAll('title');

        return $this->twig->render('Circuits/indexAdmin.html.twig', ['circuits' => $circuits]);

    public function addCircuit()
    {
        $circuitManager = new CircuitManager();
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $circuit = array_map('trim', $_POST);

            $errors = $this->validateLengths($circuit, $errors);
            $errors = $this->validateFields($circuit, $errors);

            $uploadDir = "assets/upload/";
            $uploadFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $uploadFirstName = pathinfo($_FILES['picture']['name'])['filename'];
            $uploadFinalName = uniqid($uploadFirstName) . '.' . $uploadFileType;
            $uploadFileDest = $uploadDir . $uploadFinalName;

            if (!file_exists($_FILES['picture']['tmp_name'])) {
                $errors[] = 'L\'image est requise !';
            }

            $authorizedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (file_exists($_FILES['picture']['tmp_name']) && (!in_array($uploadFileType, $authorizedExtensions))) {
                $errors[] = 'Veuillez sélectionner une image de type ' . implode(', ', $authorizedExtensions);
            }

            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE || $_FILES['picture']['error'] == 1) {
                $errors[] = 'L\'image doit avoir une taille maximale de ' . self::MAX_PICTURE_SIZE / 1000000 . ' Mo !';
            }

            if (empty($errors)) {
                move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFileDest);
                $circuitManager->save($circuit, $uploadFinalName);
                header('Location: /circuits');
            }
        }

        return $this->twig->render('Circuits/circuits-add.html.twig', [
            'errors' => $errors,
        ]);
    }

    public function validateLengths($circuit, $errors)
    {
        $maxTitleLength = 255;
        if (!empty($circuit['title']) && strlen($circuit['title']) > $maxTitleLength) {
            $errors[] = 'Le titre doit être inférieur à 255 caractères !';
        }

        $maxTraceLength = 20;
        if (!empty($circuit['trace']) && strlen($circuit['trace']) > $maxTraceLength) {
            $errors[] = 'Le tracé doit être inférieur à 20 caractères !';
        }

        return $errors;
    }

    public function validateFields($circuit, $errors)
    {
        if (empty($circuit['title'])) {
            $errors[] = 'Le nom du circuit est requis !';
        }

        if (empty($circuit['trace'])) {
            $errors[] = 'Le tracé du circuit est requis !';
        }

        if (empty($circuit['content'])) {
            $errors[] = 'La description du circuit est requise !';
        }

        if (empty($circuit['map'])) {
            $errors[] = 'La localisation du circuit est requise !';
        }

        if (empty($circuit['size'])) {
            $errors[] = 'La distance du circuit est requise !';
        }

        if (!filter_var($circuit['size'], FILTER_VALIDATE_FLOAT) && $circuit['size'] <= 0) {
            $errors[] = 'La longueur du circuit doit être un nombre positif !';
        }

        return $errors;
    }

    public function show(int $id): string
    {
        $circuitManager = new CircuitManager();
        $circuit = $circuitManager->selectOneById($id);

        return $this->twig->render('Circuits/show.html.twig', ['circuit' => $circuit]);
    }

    public function editCircuit(int $id): ?string
    {
        $circuitManager = new CircuitManager();
        $circuit = $circuitManager->selectOneById($id);
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = array_map('trim', $_POST);

            $errors = $this->validateLengths($circuit, $errors);
            $errors = $this->validateFields($circuit, $errors);

            $uploadDir = "assets/upload/";
            $uploadFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
            $uploadFirstName = pathinfo($_FILES['picture']['name'])['filename'];
            $uploadFinalName = uniqid($uploadFirstName) . '.' . $uploadFileType;
            $uploadFileDest = $uploadDir . $uploadFinalName;

            if (!file_exists($_FILES['picture']['tmp_name'])) {
                $errors[] = 'L\'image est requise !';
            }

            $authorizedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

            if (file_exists($_FILES['picture']['tmp_name']) && (!in_array($uploadFileType, $authorizedExtensions))) {
                $errors[] = 'Veuillez sélectionner une image de type ' . implode(', ', $authorizedExtensions) . ' !';
            }

            if ($_FILES['picture']['size'] > self::MAX_PICTURE_SIZE || $_FILES['picture']['error'] == 1) {
                $errors[] = 'L\'image doit avoir une taille maximale de ' . self::MAX_PICTURE_SIZE / 1000000 . ' Mo !';
            }

            if (empty($errors)) {
                move_uploaded_file($_FILES['picture']['tmp_name'], $uploadFileDest);
                $circuitManager->updateCircuit($circuit, $uploadFinalName);
                header('Location: /circuits');
            }
        }
     
        return $this->twig->render('Circuits/edit.html.twig', [
            'circuit' => $circuit,
            'errors' => $errors,
        ]);
    }
}
