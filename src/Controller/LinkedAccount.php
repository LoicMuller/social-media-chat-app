<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/linked-accounts", name="linked_account_")
 */
class LinkedAccount extends AbstractController
{

    /**
     * @Route(name="index")
     */
    public function index()
    {
        return $this->render('linked_account/index.html.twig');
    }

}