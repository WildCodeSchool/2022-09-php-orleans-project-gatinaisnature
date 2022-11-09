<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Model\EventManager;
use App\Controller\AbstractController;

class ActivityController extends AbstractController
{
    /**
     * Display home page
     */

    public function index(): string
    {
        $eventManager = new EventManager();
        $events = $eventManager->selectEventsDateDetails();
        $activityManager = new ActivityManager();
        $activities = [];
        $activities = $activityManager->selectAll();

        return $this->twig->render('Activity/activity.html.twig', ['events' => $events, 'activities' => $activities]);
    }

        /**
     * List items
     */
    public function indexAdmin(): string
    {
        $activityManager = new ActivityManager();
        $activities = $activityManager->selectAll('title');

        return $this->twig->render('Activity/index.html.twig', ['activities' => $activities]);
    }
}
