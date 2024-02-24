<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Cailloux;
use App\Entity\Categories;

class CaillouxFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $tab_categories = [
            "Faune", "Flore"
        ];
        $tab_categories2 = [];
        for ($i = 0; $i < count($tab_categories); $i++){
            $categories = new Categories();
            $categories->setNom($tab_categories[$i]);
            $tab_categories2[] = $categories;

            $manager->persist($categories);
        }

        $tab_cailloux = [
            [
                "nom" => "Tricot rayé",
                "img" => "media/tricot-raye.jpg",
                "description" => "Le tricot rayé est une espèce de serpent non venimeux, reconnaissable par son motif distinctif de bandes de couleurs alternées sur son corps. On le trouve principalement en Amérique du Nord et il se distingue par son comportement docile et son apparence élégante.",
                "categorie" => "Faune"
            ],
            [
                "nom" => "Cagou",
                "img" => "media/cagou.jpg",
                "description" => "La cagou est un oiseau endémique de la Nouvelle-Calédonie, reconnaissable par son plumage noir, son bec incurvé et sa crête distinctive. Cet oiseau terrestre, souvent timide, est emblématique de la biodiversité de la région.",
                "categorie" => "Faune"
            ],
            [
                "nom" => "Drosera",
                "img" => "media/drosera.jpg",
                "description" => "Le drosera est une plante carnivore caractérisée par de petites feuilles couvertes de tentacules glandulaires qui sécrètent une substance collante pour capturer les insectes. Originaire de milieux humides, cette plante est souvent appelée \"rossolis\" et est connue pour son adaptation unique pour obtenir des nutriments supplémentaires à partir d'insectes.",
                "categorie" => "Flore"
            ],
            [
                "nom" => "Bois bouchon",
                "img" => "media/bois-bouchon.jpg",
                "description" => "Le bois bouchon est une plante endémique de Nouvelle-Calédonie, reconnaissable par son tronc renflé à la base et son écorce liégeuse. Il est adapté aux milieux arides et a la particularité de stocker l'eau dans son tronc pour faire face aux périodes de sécheresse.",
                "categorie" => "Flore"
            ]
        ];

        for ($i = 0; $i < count($tab_cailloux); $i++) {
            $cailloux = new Cailloux();
            $cailloux->setNom($tab_cailloux[$i]["nom"]);
            $cailloux->setImg($tab_cailloux[$i]["img"]);
            $cailloux->setDescription($tab_cailloux[$i]["description"]);
            
            for ($j = 0; $j < mt_rand(2, 5); $j++){
                if($tab_cailloux[$i]["categorie"] == "Faune"){
                    $cailloux->setCategories($tab_categories2[0]);
                } else {
                    $cailloux->setCategories($tab_categories2[1]);
                }
            }

            $manager->persist($cailloux);
        }
        $manager->flush();
        
    }
}
