<?php

namespace App\Controller;

class FormController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Contact/form.html.twig');
    }
}
