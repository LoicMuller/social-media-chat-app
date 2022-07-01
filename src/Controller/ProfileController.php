<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile", name="profile_")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/show", name="index")
     */
    public function index()
    {
        return $this->render('profile/show.html.twig');
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function edit()
    {
        return $this->render('profile/edit.html.twig');
    }
}