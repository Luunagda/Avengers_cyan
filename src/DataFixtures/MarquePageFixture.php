<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\MarquePage;
use App\Entity\MotsCles;

class MarquePageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tab_mots_cles = [
            "php", "javascript", "html", "css", "symfony", "react", "angular", "vuejs", "jquery", "bootstrap", "wordpress", "prestashop", "magento", "drupal", "joomla", "laravel", "codeigniter", "cakephp", "yii", "zend", "doctrine", "mongodb", "mysql", "postgresql", "mariadb"
        ];
        $tab_mots_cles2 = [];
        for ($i = 0; $i < 25; $i++){
            $mots_cles = new MotsCles();
            $mots_cles->setMotsCles($tab_mots_cles[$i]);
            $tab_mots_cles2[] = $mots_cles;

            $manager->persist($mots_cles);
        }

        for ($i = 0; $i < 5; $i++) {
            $marques_pages = new MarquePage();
            $marques_pages->setUrl("Marque Page ". $i);
            $marques_pages->setDateCreation(new \DateTime(mt_rand(1975, 2020)));
            $marques_pages->setCommentaire("Commentaire ". $i);
            
            for ($j = 0; $j < mt_rand(2, 5); $j++){
                $marques_pages->addMotsCle($tab_mots_cles2[mt_rand(0, 24)]);
            }

            $manager->persist($marques_pages);
        }
        $manager->flush();
        
    }
}
