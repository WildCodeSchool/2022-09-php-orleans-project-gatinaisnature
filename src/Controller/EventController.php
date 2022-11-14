<?php

namespace App\Controller;

use App\Model\EventManager;
use App\Controller\AbstractController;

class EventController extends AbstractController
{
    public function indexAdmin(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectAll('title');

        return $this->twig->render('/Event/index.html.twig', ['events' => $events]);
    }
}
