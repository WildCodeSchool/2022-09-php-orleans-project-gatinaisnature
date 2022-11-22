<?php

namespace App\Controller;

use App\Model\CircuitManager;
use App\Model\OrganismManager;
use App\Model\LandscapeManager;

class CircuitController extends AbstractController
{
    private const MAX_PICTURE_SIZE = 1000000;

    public function index(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = $circuitManager->selectAll();

        return $this->twig->render('Circuits/circuits.html.twig', ['circuits' => $circuits]);
    }

    public function indexCircuitsAdmin(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = $circuitManager->selectAll('title');

        return $this->twig->render('Circuits/index.html.twig', ['circuits' => $circuits]);
    }

    public function addCircuit()
    {
        $circuitManager = new CircuitManager();
        $organismManager = new OrganismManager();
        $landscapeManager = new LandscapeManager();

        $errors = [];
        $organisms = $organismManager->selectAll();
        $landscapes = $landscapeManager->selectAll();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $circuit = $_POST;
            array_walk_recursive($circuit, function (&$var) {
                $var = trim($var);
            });

            $errors = $this->validateLengths($circuit, $errors);
            $errors = $this->validateFields($circuit, $errors);

            $uploadDir = "assets/uploads/";
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
                $circuitManager->saveCircuit($circuit, $uploadFinalName);
                $lastInsertedId = $circuitManager->selectLastId();
                $this->addLandScapeOrganism($lastInsertedId['id'], $circuit);

                header('Location: /circuits');
            }
        }

        return $this->twig->render('Circuits/add.html.twig', [
            'errors' => $errors,
            'organisms' => $organisms,
            'landscapes' => $landscapes
        ]);
    }

    public function addLandScapeOrganism($lastInsertedId, $circuit): void
    {
        $circuitManager = new CircuitManager();
        if (key_exists('organisms', $circuit)) {
            $circuitManager->saveCircuitOrganism($lastInsertedId, $circuit['organisms']);
        }
        if (key_exists('landscapes', $circuit)) {
            $circuitManager->saveCircuitLandscape($lastInsertedId, $circuit['landscapes']);
        }
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
        $organisms = $circuitManager->selectOrganisms($id);
        $landscapes = $circuitManager->selectLandscapes($id);

        return $this->twig->render('Circuits/show.html.twig', [
            'circuit' => $circuit,
            'organisms' => $organisms,
            'landscapes' => $landscapes,
        ]);
    }

    public function editCircuit(int $id): ?string
    {
        $circuitManager = new CircuitManager();
        $organismManager = new OrganismManager();
        $landscapeManager = new LandscapeManager();

        $circuit = $circuitManager->selectOneById($id);
        $id = $circuit['id'];
        $organisms = $organismManager->selectAll();
        $landscapes = $landscapeManager->selectAll();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $circuit = $_POST;
            array_walk_recursive($circuit, function (&$var) {
                $var = trim($var);
            });

            $errors = $this->validateLengths($circuit, $errors);
            $errors = $this->validateFields($circuit, $errors);

            $uploadDir = "assets/uploads/";
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
                $circuitManager->updateCircuit($circuit, $id, $uploadFinalName);
                $this->editLandScapeOrganism($id, $circuit);

                $circuitManager->deleteCircuitOrganism($id);
                $circuitManager->saveCircuitOrganism($id, $circuit['organisms']);
                $circuitManager->deleteCircuitLandscape($id);
                $circuitManager->saveCircuitLandscape($id, $circuit['landscapes']);

                header('Location: /circuits');
            }
        }

        return $this->twig->render('Circuits/edit.html.twig', [
            'circuit' => $circuit,
            'organisms' => $organisms,
            'landscapes' => $landscapes,
            'errors' => $errors
        ]);
    }

    public function editLandScapeOrganism($id, $circuit): void
    {
        $circuitManager = new CircuitManager();
        if (key_exists('organisms', $circuit)) {
            $circuitManager->deleteCircuitOrganism($id);
            $circuitManager->saveCircuitOrganism($id, $circuit['organisms']);
        }
        if (key_exists('landscapes', $circuit)) {
            $circuitManager->deleteCircuitLandscape($id);
            $circuitManager->saveCircuitLandscape($id, $circuit['landscapes']);
        }
    }

    public function removeCircuit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $circuitManager = new CircuitManager();
            $circuitManager->delete((int)$id);

            header('Location: /admin/circuits/index');
        }
    }
}
