<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/marque/page", requirements: ["_locale" => "en|es|fr"], name: "marque_page_")]
class MarquePageController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $marques_pages = $entityManager->getRepository(MarquePage::class)->findAll();

        return $this->render('marque_page/index.html.twig', [
            'controller_name' => 'MarquePageController',
            'marques_pages' => $marques_pages,
        ]);
    }

    #[Route("/ajouter", name: "ajouter")]
    public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
    {
        $marques_pages = new MarquePage();
        $marques_pages->setUrl("https://www.symfony.com/");
        $marques_pages->setDateCreation(new \DateTime());
        $marques_pages->setCommentaire("C'est un framework PHP très puissant et très pratique");

        $entityManager->persist($marques_pages);
        $entityManager->flush();

        return new Response("MarquePage sauvegardé avec l'id ". $marques_pages->getId());
    }

    #[Route("/detail/{id<\d+>}", name: "detail")]
    public function afficherMarquePage(int $id, EntityManagerInterface $entityManager):Response
    {
        $marque_page = $entityManager->getRepository(MarquePage::class)->find($id);
        if (!$marque_page) {
            throw $this->createNotFoundException(
            "Aucun marque-page avec l'id ". $id
            );
        }
        return $this->render('marque_page/detail.html.twig', [
            'marque_page' => $marque_page,
        ]);
    }
}
