<?php

namespace App\Controller;

use App\Model\CircuitManager;


class CircuitController extends AbstractController
{
    private CircuitManager $model;

    /**
     * Display circuits page
     */
    public function index(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = $circuitManager->selectAll();

        return $this->twig->render('Circuits/chooseCircuits.html.twig', ['circuits' => $circuits]);
    }

    /* Create a circuit */
    public function addCircuit()
    {
        $circuitManager = new CircuitManager;
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $circuit = array_map('trim', $_POST);
            $circuit = array_map('htmlentities', $circuit);

            //Validation
            $errors = $this->validate($circuit);

            //Si validation OK : insertion BDD + redirection
            if (empty($errors)) {
                $circuit = $circuitManager->save($circuit);
                header('Location: /admin/circuits/');
            }

            return $this->twig->render('admin-circuits.html.twig', [
                'circuit' => $circuit,
                'errors' => $errors,
            ]);
        }
        return $this->twig->render('admin-circuits.html.twig');
    }

    private function validate(array $circuit)
    {
        if (empty($circuit['title'])) {
            $errors[] = 'Le nom du circuit est requis !';
        }

        $maxTitleLength = 255;
        if (!empty($circuit['title']) && strlen($circuit['title']) > $maxTitleLength) {
            $errors[] = 'Le titre doit être inférieur à 255 caractères !';
        }

        if (empty($circuit['size'])) {
            $errors[] = 'La distance du circuit est requise !';
        }

        if (empty($circuit['content'])) {
            $errors[] = 'La description du circuit est requise !';
        }

        if (empty($circuit['map'])) {
            $errors[] = 'La localisation du circuit est requise !';
        }

        if (empty($circuit['trace'])) {
            $errors[] = 'Le tracé du circuit est requis !';
        }

        $maxTraceLength = 20;
        if (!empty($circuit['trace']) && strlen($circuit['trace']) > $maxTraceLength) {
            $errors[] = 'Le tracé doit être inférieur à 20 caractères !';
        }

        /*     if (empty($circuit['picture_circuit'])) {
            $errors[] = 'Une photo du circuit est requise !';
        } */

        return $errors ?? [];
    }
}
