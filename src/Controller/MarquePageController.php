<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use Doctrine\ORM\EntityManagerInterface;

class MarquePageController extends AbstractController
{
    #[Route('/marque/page', name: 'app_marque_page')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $marques_pages = $entityManager->getRepository(MarquePage::class)->findAll();

        return $this->render('marque_page/index.html.twig', [
            'controller_name' => 'MarquePageController',
            'marques_pages' => $marques_pages,
        ]);
    }

    #[Route("/marque/page/ajouter", name: "marque_page_ajouter")]
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
}
