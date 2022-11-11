<?php

namespace App\Controller;

use App\Model\OrganismManager;

class OrganismController extends AbstractController
{
    /**
     * Display admin organisms page
     */
    public function index(): string
    {
        $organismManager = new OrganismManager();
        $organisms = $organismManager->selectAll();

        return $this->twig->render('Organism/index.html.twig', ['organisms' => $organisms]);
    }
}
