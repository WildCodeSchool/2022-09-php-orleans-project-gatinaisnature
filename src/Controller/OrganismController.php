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
        $organism = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $organism = array_map('trim', $_POST);

            $maxCharOrganismName = 255;
            if (strlen($organism['name']) > $maxCharOrganismName) {
                $errors[] = 'Le nom doit être inférieur à ' . $maxCharOrganismName . ' caractères.';
            }

            $errors = $this->isEmpty($organism, $errors);

            if (empty($errors)) {
                $organismManager = new OrganismManager();
                $organismManager->insert($organism['name'], $organism['link'], $organism['picture']);

                header('Location: /especes');
            }
        }
        return $this->twig->render('Organism/add.html.twig', ['errors' => $errors]);
    }

    public function isEmpty(array $organism, array $errors): array
    {
        if (empty($organism['name']) || !isset($organism['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (empty($organism['link']) || !isset($organism['link'])) {
            $errors[] = 'Le lien wikipédia est obligatoire';
        }

        if (empty($organism['picture']) || !isset($organism['picture'])) {
            $errors[] = 'Le lien d\'une photo est obligatoire';
        }

        return $errors;
    }
}
