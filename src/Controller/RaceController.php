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

        return $this->twig->render('Races/add.html.twig', ['races' => $races]);
    }
}