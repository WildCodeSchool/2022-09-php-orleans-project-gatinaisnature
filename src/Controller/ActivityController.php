<?php

namespace App\Controller;

use App\Model\ActivityManager;
use App\Controller\AbstractController;

class ActivityController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {

        $activityManager = new ActivityManager();
        $activities = [];
        $activities = $activityManager->selectAll();


        return $this->twig->render('Activity/activity.html.twig', ['activities' => $activities]);
    }
}
