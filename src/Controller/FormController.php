<?php

namespace App\Controller;

class FormController extends AbstractController
{
    public const LASTNAME_LENGTH = 100;
    public const FIRSTNAME_LENGTH = 100;
    public const EMAIL_LENGTH = 255;
    /**
     * Display form page
     */
    public function index(string $answer = ''): string
    {
        $addSub = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $addSub = array_map('trim', $_POST);

            if (strlen($addSub['lastname']) > self::LASTNAME_LENGTH) {
                $errors[] = 'Le nom doit être inférieur à ' . self::LASTNAME_LENGTH . 'caractères !';
            }

            if (strlen($addSub['firstname']) > self::FIRSTNAME_LENGTH) {
                $errors[] = 'Le prénom doit être inférieur à ' . self::FIRSTNAME_LENGTH . 'caractères !';
            }

            if (strlen($addSub['email']) > self::EMAIL_LENGTH) {
                $errors[] = 'L\'adresse e-mail doit être inférieure à ' . self::EMAIL_LENGTH . 'caractères !';
            }

            if (!filter_var(($addSub['email']), FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Ceci n\'est pas un format d\'adresse e-mail';
            }

            $errors = $this->isEmpty($addSub, $errors);

            if (empty($errors)) {
                header('location: /contact?answer=good');
            }
        }

        return $this->twig->render(
            'Contact/form.html.twig',
            ['errors' => $errors, 'contact' => $addSub, 'answer' => $answer]
        );
    }

    public function isEmpty(array $addSub, array $errors): array
    {
        if (empty($addSub['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (empty($addSub['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }

        if (empty($addSub['email'])) {
            $errors[] = 'L\'adresse e-mail est obligatoire';
        }

        if (empty($addSub['subject'])) {
            $errors[] = 'Le sujet de la question est obligatoire';
        }

        if (empty($addSub['message'])) {
            $errors[] = 'Le message est obligatoire';
        }
        return $errors;
    }
}
