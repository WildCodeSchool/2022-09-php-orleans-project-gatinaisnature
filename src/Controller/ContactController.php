<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    public const LASTNAME_LENGTH = 100;
    public const FIRSTNAME_LENGTH = 100;
    public const EMAIL_LENGTH = 255;
    /**
     * Display form page
     */
    public function index(string $answer = ''): string
    {
        $contact = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact = array_map('trim', $_POST);

            if (strlen($contact['lastname']) > self::LASTNAME_LENGTH) {
                $errors[] = 'Le nom doit être inférieur à ' . self::LASTNAME_LENGTH . ' caractères !';
            }

            if (strlen($contact['firstname']) > self::FIRSTNAME_LENGTH) {
                $errors[] = 'Le prénom doit être inférieur à ' . self::FIRSTNAME_LENGTH . ' caractères !';
            }

            if (strlen($contact['email']) > self::EMAIL_LENGTH) {
                $errors[] = 'L\'adresse e-mail doit être inférieure à ' . self::EMAIL_LENGTH . ' caractères !';
            }

            if (!filter_var(($contact['email']), FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Ceci n\'est pas un format d\'adresse e-mail';
            }

            $errors = $this->isEmpty($contact, $errors);

            if (empty($errors)) {
                header('location: /contact?answer=good');
            }
        }

        return $this->twig->render(
            'Contact/form.html.twig',
            ['errors' => $errors, 'contact' => $contact, 'answer' => $answer]
        );
    }

    public function isEmpty(array $contact, array $errors): array
    {
        if (empty($contact['lastname'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (empty($contact['firstname'])) {
            $errors[] = 'Le prénom est obligatoire';
        }

        if (empty($contact['email'])) {
            $errors[] = 'L\'adresse e-mail est obligatoire';
        }

        if (empty($contact['subject'])) {
            $errors[] = 'Le sujet de la question est obligatoire';
        }

        if (empty($contact['message'])) {
            $errors[] = 'Le message est obligatoire';
        }
        return $errors;
    }
}
