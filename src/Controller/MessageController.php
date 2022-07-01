<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Status;
use App\Form\MessageFormType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/message", name="message_")
 */
class MessageController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/new", name="new")
     */
    public function newMessage(Request $req, EntityManagerInterface $em): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageFormType::class, $message);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();

            $message->setUserId($user);
            ($message->getPlanifiedAt() != null) ? $message->setStatus('planified') : $message->setStatus('sent');
            $message->setCreatedAt(new \DateTimeImmutable('now'));

            $em->persist($message);
            $em->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('message/new.html.twig', [
            'messageForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/sent", name="sent", methods={"GET"})
     */
    public function messagesSent(MessageRepository $messageRepo): Response
    {
        return $this->render('message/sent.html.twig', [
            'messages' => $messageRepo->findBy(
                ['status' => 'sent'],
                ['created_at' => 'ASC']
            ),
        ]);
    }

    /**
     * @Route("/planified", name="planified", methods={"GET"})
     */
    public function messagesPlanified(MessageRepository $messageRepo): Response
    {
        return $this->render('message/planified.html.twig', [
            'messages' => $messageRepo->findBy(
                ['status' => 'planified'],
                ['created_at' => 'ASC']
            )
        ]);
    }
}