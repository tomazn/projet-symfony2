<?php

namespace EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\categorie;

class LoadCategorieData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $categorie = new categorie();
        $categorie->setIntitule('Aucun');

        $manager->persist($categorie);
        $manager->flush();
    }
}