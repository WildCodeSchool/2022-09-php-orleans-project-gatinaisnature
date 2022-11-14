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
            $errors = $this->isImage($organism, $errors);

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
        if (!isset($organism['name']) || empty($organism['name'])) {
            $errors[] = 'Le nom est obligatoire';
        }

        if (!isset($organism['link']) || empty($organism['link'])) {
            $errors[] = 'Le lien wikipédia est obligatoire';
        }

        if (!isset($organism['picture']) || empty($organism['picture'])) {
            $errors[] = 'Le lien d\'une photo est obligatoire';
        }

        return $errors;
    }

    public function isImage(array $organism, array $errors)
    {
        $url_headers = get_headers($organism['picture'], 1);
        $extension = ['png', 'jpg', 'webp'];
        if (isset($url_headers['Content-Type'])) {
            $type = strtolower($url_headers['Content-Type']);

            $valid_img_type = array();
            $valid_img_type['image/png'] = '';
            $valid_img_type['image/jpg'] = '';
            $valid_img_type['image/webp'] = '';

            if (!isset($valid_img_type[$type])) {
                $errors[] = 'Le fichier doit être de type ' . implode(", ", $extension);
            }
        }

        return $errors;
    }
}