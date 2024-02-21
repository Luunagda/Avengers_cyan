<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Cailloux;
use App\Entity\Categories;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/lecailloux", requirements: ["_locale" => "en|es|fr"], name: "le_cailloux_")]
class LeCaillouxController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $cailloux = $entityManager->getRepository(Cailloux::class)->findAll();

        return $this->render('le_cailloux/cailloux.html.twig', [
            'controller_name' => 'LeCaillouxController',
            'cailloux' => $cailloux,
        ]);
    }
    
    #[Route("/faune", name: "faune")]
    public function listeFaune(/* $categories, */EntityManagerInterface $entityManager):Response
    {
        $categorie = $entityManager
            ->getRepository(Categories::class)
            ->findByNom('faune');

        $faune = $entityManager
            ->getRepository(Cailloux::class)
            ->findByCategories($categorie);
       
        return $this->render('le_cailloux/faune.html.twig', [
            'faune' => $faune,
        ]);
    }

    #[Route("/flore", name: "flore")]
    public function listeFlore(EntityManagerInterface $entityManager):Response
    {
        $categorie = $entityManager
            ->getRepository(Categories::class)
            ->findByNom('flore');

        $flore = $entityManager
            ->getRepository(Cailloux::class)
            ->findByCategories($categorie);
       
        return $this->render('le_cailloux/flore.html.twig', [
            'flore' => $flore,
        ]);
    }
    
    #[Route("/detail/{id<\d+>}", name: "detail")]
    public function afficherLivre(int $id, EntityManagerInterface $entityManager):Response
    {
        $cailloux = $entityManager->getRepository(Cailloux::class)->find($id);
        if (!$cailloux) {
            throw $this->createNotFoundException(
            "Aucun cailloux avec l'id ". $id
            );
        }
        return $this->render('le_cailloux/detail.html.twig', [
            'cailloux' => $cailloux,
        ]);
    }

}


/*

class LivreController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $livre = $entityManager->getRepository(Livre::class)->findAll();

        return $this->render('livre/index.html.twig', [
            'controller_name' => 'LivreController',
            'livre' => $livre,
        ]);
    }
    
}




*/