<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/message", name="message_")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/new", name="new")
     */
    public function newMessage()
    {
        return $this->render('message/new.html.twig');
    }

    /**
     * @Route("/sent", name="sent")
     */
    public function messagesSent()
    {
        return $this->render('message/sent.html.twig');
    }

    /**
     * @Route("/planified", name="planified")
     */
    public function messagesPlanified()
    {
        return $this->render('message/planified.html.twig');
    }
}