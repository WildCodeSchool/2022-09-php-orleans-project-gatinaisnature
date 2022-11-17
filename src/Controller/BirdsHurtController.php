<?php

namespace App\Controller;

use App\Model\BirdsHurtManager;
use App\Controller\AbstractController;

class BirdsHurtController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $birdsHurtManager = new BirdsHurtManager();
        $birdsHurt = $birdsHurtManager->selectAll();

        return $this->twig->render('BirdsHurt/birdsHurt.html.twig', ['birdsHurt' => $birdsHurt]);
    }
}
