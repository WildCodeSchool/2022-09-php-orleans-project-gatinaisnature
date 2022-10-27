<?php

namespace App\Controller;

use App\Model\EventManager;
use App\Controller\AbstractController;

class ActivityController extends AbstractController
{
    /**
     * Display home
     */
    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectEventsDateDetails();


        return $this->twig->render('Activity/activity.html.twig', ['events' => $events]);
    }
}
