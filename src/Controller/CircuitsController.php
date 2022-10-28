<?php

namespace App\Controller;
use App\Model\CircuitManager;

class CircuitsController extends AbstractController
{
    /**
     * Display circuits page
     */
    public function index(): string
    {
        $circuitManager = new CircuitManager();
        $circuits = [];
        $circuits = $circuitManager->selectAll();

        return $this->twig->render('Circuits/chooseCircuits.html.twig', ['circuits'=>$circuits]);
    }
}
