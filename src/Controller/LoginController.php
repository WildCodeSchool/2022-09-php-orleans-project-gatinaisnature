<?php

namespace App\Controller;

use App\Model\UserManager;

class LoginController extends AbstractController
{
    public function login(): string
    {
        $errors = [];
        $profils = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $profils = array_map('trim', $_POST);

            if (empty($profils['email'])) {
                $errors[] = 'L\'adresse e-mail est obligatoire';
            }

            if (!filter_var($profils['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'L\'adresse e-mail n\'a pas le bon format';
            }

            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($profils['email']);
            if ($user === false) {
                $errors[] = 'L\'adresse e-mail est inconnu';
            } elseif (!password_verify($profils['password'], $user['password'])) {
                $errors[] = 'Le mot de passe est incorrect';
            }

            if (empty($errors)) {
                $_SESSION['user_id'] = $user['id'];
                header('Location: /admin');
                return '';
            }
        }
        return $this->twig->render('Admin/login.html.twig', [
            'errors' => $errors,
            'profils' => $profils,
        ]);
    }
}
