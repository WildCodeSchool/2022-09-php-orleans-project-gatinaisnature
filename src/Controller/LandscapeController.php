<?php

namespace App\Controller;

class LandscapeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Landscape/landscape.html.twig');
    }
}
