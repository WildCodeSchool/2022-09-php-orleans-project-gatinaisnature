<?php

namespace App\Controller;

class ActivityController extends AbstractController
{
    /**
     * Display home page
     */
    public function activity(): string
    {
        return $this->twig->render('Activity/activity.html.twig');
    }
}
