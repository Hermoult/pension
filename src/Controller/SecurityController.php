<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{    
    /**
     * registration
     *
     * @Route ("/inscription", name="security_registration")
     */
    public function registration(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder) {

        $user = new User;

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setCreatedAt(new DateTime());
            $user->setCreatedBy($user->getUserName());
            $user->setAccreditation(1);
            $manager->persist($user);
            $manager->flush();

            return $this->render("security/index.html.twig", [
                'user' => $user
            ]);
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * login
     *
     * @Route ("/connexion", name="security_login")
     */
    public function login () {
        return $this->render('pension/home.html.twig');
    }

    /**
     * @Route ("/deconnexion", name="security_logout")
     */
    public function logout (){}
}
