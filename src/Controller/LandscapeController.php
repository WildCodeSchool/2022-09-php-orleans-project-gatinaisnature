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
        return $this->twig->render('Landscape/landscape.html.twig');
    }

    public function indexLandscapeAdmin(): string
    {
        $landscapeManager = new LandscapeManager();
        $landscapes = $landscapeManager->selectAll('title');

        return $this->twig->render('Landscape/indexAdmin.html.twig', ['landscapes' => $landscapes]);
    }

    public function edit(int $id)
    {
        echo($id);
    }
}
