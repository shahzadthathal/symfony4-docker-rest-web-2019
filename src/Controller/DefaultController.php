<?php
	
// src/Controller/DefaultController.php

namespace App\Controller;

// ...
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    // ...

    /**
     * Load the site definition and redirect to the default page.
     *
     * @Route("/", name="app_homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }
}