<?php

namespace App\Controller;

use App\Client\DiscordClientInterface;
use App\Client\SlackClientInterface;
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
    CONST SLACK = 'Slack';
    CONST DISCORD = 'Discord';
    CONST SENT = 'sent';
    CONST PLANIFIED = 'planified';

    public function __construct(
        Security               $security,
        SlackClientInterface   $slackClient,
        DiscordClientInterface $discordClient
    )
    {
        $this->security = $security;
        $this->slackClient = $slackClient;
        $this->discordClient = $discordClient;
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
            ($message->getPlanifiedAt() != null) ? $message->setStatus(MessageController::PLANIFIED) : $message->setStatus(MessageController::SENT);
            $message->setCreatedAt(new \DateTimeImmutable('now'));

            $em->persist($message);
            $em->flush();

            if ($message->getSocialMedia() == MessageController::SLACK) {
                $this->slackClient->executeRequest($message->getContent());
            } elseif ($message->getSocialMedia() == MessageController::DISCORD) {
                $this->discordClient->executeRequest($message->getContent());
            } else {
                $this->slackClient->executeRequest($message->getContent());
                $this->discordClient->executeRequest($message->getContent());
            }

            $this->addFlash('success', 'Message envoyé avec succès !');

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
        $user = $this->security->getUser();
        return $this->render('message/sent.html.twig', [
            'messages' => $messageRepo->findBy(
                ['user_id' => $user, 'status' => 'sent'],
                ['created_at' => 'DESC']
            ),
        ]);
    }

    /**
     * @Route("/planified", name="planified", methods={"GET"})
     */
    public function messagesPlanified(MessageRepository $messageRepo): Response
    {
        $user = $this->security->getUser();
        return $this->render('message/planified.html.twig', [
            'messages' => $messageRepo->findBy(
                ['user_id' => $user, 'status' => 'planified'],
                ['created_at' => 'DESC']
            )
        ]);
    }
}