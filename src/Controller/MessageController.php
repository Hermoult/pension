<?php

namespace App\Controller;

use DateTime;
use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function message(HttpFoundationRequest $request, EntityManagerInterface $manager,UserInterface $user)
    {
        $message = new Message;
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setDateSending(new DateTime());
            $message->setUserIduser($user);
            $message->setSender($user->getUsername());

            $manager->persist($message);
            $manager->flush();

            return $this->redirectToRoute('profil');
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}