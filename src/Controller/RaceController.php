<?php

namespace App\Controller;

use App\Model\RaceManager;

class RaceController extends AbstractController
{
    /**
     * Display admin races page
     */
    public function index(): string
    {
        $raceManager = new RaceManager();
        $races = $raceManager->selectAll();

        return $this->twig->render('Races/index.html.twig', ['races' => $races]);
    }

    public function add()
    {
        $race = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $race = array_map('trim', $_POST);

            $maxCharRaceName = 255;
            if (strlen($race['name']) < $maxCharRaceName) {
                $errors[] = 'Le nom doit être inférieur à ' . $maxCharRaceName . ' caractères.';
            }

            $errors = $this->isEmpty($race, $errors);

            if (empty($errors)) {
                $raceManager = new RaceManager();
                $raceManager->insert($race['name'], $race['link'], $race['picture']);

                header('Location: /races');
            }
        }
        return $this->twig->render('Races/add.html.twig', ['errors' => $errors]);
    }

    public function isEmpty(array $race, array $errors): array
    {
        if (!isset($race['name']) || empty($race['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (!isset($race['link']) || empty($race['link'])) {
            $errors[] = 'Le lien wikipédia est obligatoire';
        }

        if (!isset($race['picture']) || empty($race['picture'])) {
            $errors[] = 'Le lien d\'une photo est obligatoire';
        }

        return $errors;
    }
}
