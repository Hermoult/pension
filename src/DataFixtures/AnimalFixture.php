<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AnimalFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=1; $i <=5; $i++){
            $article = new Animal();
            $article ->setCreatedat(new \DateTime())
            ->setType("chien")
            ->setCreatedby("admin")
            ->setPhoto("https://placehold.it/150x150")
            ->setLocalisation(false)
            ->setEsthetictreatment(false);
        }

        $manager->flush();
    }
}
