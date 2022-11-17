<?php

namespace App\Controller;

class AdminController extends AbstractController
{
    /**
     * Display home admin page
     */
    public function index(): string
    {
        if (!isset($_SESSION['user_id'])) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render('Errors/error.html.twig', [
                'error' => '401',
            ]);
        }
        return $this->twig->render('Admin/index.html.twig');
    }
}
