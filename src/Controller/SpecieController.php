<?php

namespace App\Controller;

use App\Model\SpecieManager;

class SpecieController extends AbstractController
{
    /**
     * Display admin races page
     */
    public function index(): string
    {
        $specieManager = new SpecieManager();
        $species = $specieManager->selectAll();

        return $this->twig->render('Species/index.html.twig', ['species' => $species]);
    }
}
