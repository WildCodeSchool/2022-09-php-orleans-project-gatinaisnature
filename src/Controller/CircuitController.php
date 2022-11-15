<?php

namespace App\Controller;

use App\Model\CircuitManager;

class CircuitController extends AbstractController
{
    public const MAX_PICTURE_SIZE = 1000000;
    /**
     * Display circuits page
     */
    public function index(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = $circuitManager->selectAll();

        return $this->twig->render('Circuits/chooseCircuits.html.twig', ['circuits' => $circuits]);
    }

    public function showCircuit(int $id): string
    {
        $circuitManager = new CircuitManager();
        $circuit = $circuitManager->selectOneById($id);

        return $this->twig->render('Circuit/show.html.twig', ['circuit' => $circuit]);
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
