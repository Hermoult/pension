<?php

namespace App\Controller;

use DateTime;
use App\Entity\Animal;
use App\Entity\User;
use App\Form\NewAnimalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PensionController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render ('pension/home.html.twig');
    }
    
    /**
     * @Route("/profil", name="profil")
     */
    public function profil(UserInterface $user)
    {
        return $this->render('pension/profil.html.twig', [
            'user' => $user
        ]);
    }
    

    /**
     * @Route("/tarifs", name="tarifs")
     */
    public function tarifs() 
    {
        return $this->render ('pension/tarifs.html.twig');
    }

    /**
     * @Route ("/newAnimal", name="new_animal")
     * @Route ("/Animal/{id}/edit", name="edit_animal")
     * 
     */
    public function manageAnimal(Animal $animal = null,Request $request, EntityManagerInterface $manager,UserInterface $user)
    {
        if (!$animal){
            $animal = new Animal;
        }

        $forma = $this->createForm(NewAnimalType::class, $animal);

        $forma->handleRequest($request);

        if ($forma->isSubmitted() && $forma->isValid()) {

            if (!$animal->getId()){
                $animal->setCreatedAt(new DateTime());
                $animal->setCreatedBy($user->getUsername());
            }else{
                $animal->setUpdatedAt(new DateTime());
                $animal->setUpdatedBy($user->getUsername());
            }
            $animal->setUserIduser($user);
            $animal->setLocalisation(false);
            $manager->persist($animal);
            $manager->flush();

            return $this->redirectToRoute('show_animal', [
                'id' => $animal->getId()
            ]);
        }
        return $this->render("pension/new.html.twig", [
            'forma' => $forma->createView(),
            'editMode' => $animal->getId() !== null
        ]);
    }

    /**
     * @Route ("/fiche/{id}", name="show_animal")
     */
    public function showAnimal($id){
        return $this->render('pension/animal.html.twig', [
            'animal'=> $id
        ]);
    }


}
