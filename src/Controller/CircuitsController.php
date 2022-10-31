<?php

namespace App\Controller;

class CircuitsController extends AbstractController
{
    /**
     * Display circuits page
     */
    public function index(): string
    {
        return $this->twig->render('Circuits/chooseCircuits.html.twig');
    }
}
