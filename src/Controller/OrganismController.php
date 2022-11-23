<?php

namespace App\Controller;

use App\Model\OrganismManager;

class OrganismController extends AbstractController
{
    /**
     * Display admin organisms page
     */
    public function index(): string
    {
        $organismManager = new OrganismManager();
        $organisms = $organismManager->selectAll("name");

        return $this->twig->render('Organism/index.html.twig', ['organisms' => $organisms]);
    }

    public function add()
    {
        $this->isAuthorized();
        $organism = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $organism = array_map('trim', $_POST);

            $maxCharOrganismName = 255;
            if (strlen($organism['name']) > $maxCharOrganismName) {
                $errors[] = 'Le nom doit être inférieur à ' . $maxCharOrganismName . ' caractères.';
            }

            $errors = $this->isEmpty($organism, $errors);
            $errors = $this->isImage($organism, $errors);

            if (empty($errors)) {
                $organismManager = new OrganismManager();
                $organismManager->insert($organism['name'], $organism['link'], $organism['picture']);

                header('Location: /admin/especes/index');
            }
        }
        return $this->twig->render('Organism/add.html.twig', ['errors' => $errors]);
    }

    public function isEmpty(array $organism, array $errors): array
    {
        if (!isset($organism['name']) || empty($organism['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (!isset($organism['link']) || empty($organism['link'])) {
            $errors[] = 'Le lien wikipédia est obligatoire';
        }

        if (!isset($organism['picture']) || empty($organism['picture'])) {
            $errors[] = 'Le lien d\'une photo est obligatoire';
        }

        if (!filter_var($organism['link'], FILTER_VALIDATE_URL)) {
            $errors[] = 'Le lien wikipedia n\'est pas correct';
        }

        if (!filter_var($organism['picture'], FILTER_VALIDATE_URL)) {
            $errors[] = 'Le lien image n\'est pas correct';
        }

        return $errors;
    }

    public function isImage(array $organism, array $errors)
    {
        $extension = pathinfo($organism['picture'], PATHINFO_EXTENSION);
        $authorizedMimes = ['png', 'jpg', 'jpeg', 'webp'];

        if (!in_array($extension, $authorizedMimes)) {
            $errors[] = 'Le fichier doit être de type ' . implode(", ", $authorizedMimes);
        }

        return $errors;
    }

    public function edit(int $id)
    {
        $this->isAuthorized();
        $organism = [];
        $errors = [];

        $organismManager = new OrganismManager();
        $organism = $organismManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $organism = array_map('trim', $_POST);
            $organism['id'] = $id;
            $maxCharOrganismName = 255;
            if (strlen($organism['name']) > $maxCharOrganismName) {
                $errors[] = 'Le nom doit être inférieur à ' . $maxCharOrganismName . ' caractères.';
            }

            $errors = $this->isEmpty($organism, $errors);
            $errors = $this->isImage($organism, $errors);

            if (empty($errors)) {
                $organismManager->update($organism);

                header('Location: /admin/especes/index');
            }
        }
        return $this->twig->render('Organism/edit.html.twig', [
            'organism' => $organism,
            'errors' => $errors,
        ]);
    }

    public function delete()
    {
        $this->isAuthorized();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $organismManager = new OrganismManager();
            $organismManager->delete((int)$id);

            header('Location:/admin/especes/index');
        }
    }
}
