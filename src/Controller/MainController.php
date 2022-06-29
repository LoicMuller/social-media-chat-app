<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="app_")
 */
class MainController extends AbstractController
{
    /**
     * @Route(name="index")
     */
    public function index()
    {
        if($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->render('main/home.html.twig');
        }

        return $this->redirectToRoute('app_login');
    }
}