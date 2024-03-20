<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Employe;
use App\Entity\Adresse;


class EmployeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $prenoms = ["Jean", "Marie", "Sophie", "Pierre", "Emma", "Lucas", "Léa", "Thomas", "Camille", "Antoine"];

        $noms_de_famille = ["Martin", "Bernard", "Dubois", "Thomas", "Robert", "Richard", "Petit", "Durand", "Leroy", "Moreau"];

        $rue = ["rue de la Paix", "rue de la Liberté", "rue de la République", "rue du Général de Gaulle", "rue du 8 mai 1945", "rue de la Gare", "rue des Ecoles", "rue des Lilas", "rue des Champs", "rue des Vignes"];

        $pays = ["France", "Belgique", "Suisse", "Espagne", "Italie", "Allemagne", "Angleterre", "Portugal", "Pays-Bas", "Suède"];

        $ville = ["Paris", "Lyon", "Marseille", "Toulouse", "Nice", "Nantes", "Strasbourg", "Montpellier", "Bordeaux", "Lille"];

        for ($i = 0; $i < 5; $i++) {
            $adresse = new Adresse();
            $adresse->setRue(mt_rand(10, 100).' '.$rue[array_rand($rue)]);
            $adresse->setVille($ville[array_rand($ville)]);
            $adresse->setPays($pays[array_rand($pays)]);
            $adresse->setCodePostal(mt_rand(10000, 99999));
        
            $manager->persist($adresse);
            

            $employe = new Employe();
            $employe->setPrenom($prenoms[array_rand($prenoms)]);
            $employe->setNom($noms_de_famille[array_rand($noms_de_famille)]);
            $employe->setAdresse($adresse);

            $manager->persist($employe);
            
        }
        $manager->flush();
        
    }
}
