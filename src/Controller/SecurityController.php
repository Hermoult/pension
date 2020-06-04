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
     * @Route ("/inscription", name="security_registration")
     * @Route ("/profil/{id}/edit", name="profil_edit")
     */
    public function registration(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder, User $user = null) {

        if (!$user) {
        $user = new User;
        }
        
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if (!$user->getId()){
                $user->setCreatedAt(new DateTime());
                $user->setCreatedBy($user->getUserName());
            }else{
                $user->setUpdatedAt(new DateTime());
                $user->setUpdatedBy($user->getUserName());
            }
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
                $user->setAccreditation(1);
                $manager->persist($user);
            $manager->flush();

            return $this->render("security/index.html.twig", [
                'user' => $user
            ]);
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView(),
            'editMode' => $user->getId() !== null
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
