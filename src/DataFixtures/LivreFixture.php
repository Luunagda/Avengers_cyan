<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use App\Entity\Auteur;

class LivreFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
       
        // Création de 15 livres
        for ($i = 0; $i < 15; $i++) {
            $auteur = new Auteur();
            $auteur->setPrenom('Prenom_'.$i);
            $auteur->setNom('Nom_'.$i);

            $livre = new Livre();
            $livre->setTitre('Livre '.$i);
            $livre->setAnnee(mt_rand(1975, 2020));
            $livre->setNbPages(mt_rand(45, 1500));
            $livre->setAuteur($auteur);

            $manager->persist($livre);
            $manager->persist($auteur);
        }
        $manager->flush();
        
    }
}
