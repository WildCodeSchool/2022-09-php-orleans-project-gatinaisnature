<?php

namespace App\Controller;

class CircuitsPageController extends AbstractController
{
    /**
     * Display circuits page
     */
    public function index(): string
    {
        return $this->twig->render('Circuits/chooseCircuits.html.twig');
    }
}
