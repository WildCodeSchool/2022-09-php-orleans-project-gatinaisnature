<?php

namespace App\Controller;

use App\Model\LandscapeManager;
use App\Controller\AbstractController;

class LandscapeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $landscapeManager = new LandscapeManager();
        $landscapes = $landscapeManager->selectAll();

        return $this->twig->render('Landscape/landscape.html.twig', ['landscapes' => $landscapes]);
    }
    /**
     * Display landscape page
     */
    public function getLandscapeByCircuit(int $circuitId): string
    {
        $landscapeManager = new LandscapeManager();
        $landscapes = $landscapeManager->getLandscapeByCircuit($circuitId);

        return $this->twig->render('Landscape/landscape.html.twig', ['landscapes' => $landscapes]);
    }
}
