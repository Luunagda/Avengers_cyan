<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Livre;
use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/livre", requirements: ["_locale" => "en|es|fr"], name: "livre_")]
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
    
    #[Route("/ajouter", name: "ajouter")]
    public function ajouterLivre(EntityManagerInterface $entityManager): Response
    {
        $auteur = new Auteur();
        $auteur->setPrenom("V.E.");
        $auteur->setNom("Schwab");
        
        $livre = new Livre();
        $livre->setTitre("Vicious");
        $livre->setAnnee(2019);
        $livre->setNbPages(532);
        $livre->setAuteur($auteur);

        $entityManager->persist($auteur);
        $entityManager->persist($livre);
        $entityManager->flush();

        return new Response("Livre sauvegardé avec l'id ". $livre->getId());
    }

    #[Route("/detail/{id<\d+>}", name: "detail")]
    public function afficherLivre(int $id, EntityManagerInterface $entityManager):Response
    {
        $livre = $entityManager->getRepository(Livre::class)->find($id);
        if (!$livre) {
            throw $this->createNotFoundException(
            "Aucun livre avec l'id ". $id
            );
        }
        return $this->render('livre/detail.html.twig', [
            'livre' => $livre,
        ]);
    }
}



