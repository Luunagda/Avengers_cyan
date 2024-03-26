<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\MarquePage;
use App\Entity\MotsCles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\MarquePageType;


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

    // #[Route("/ajouter", name: "ajouter")]
    // public function ajouterMarquePage(EntityManagerInterface $entityManager): Response
    // {
    //     $mots_cles = new MotsCles();
    //     $mots_cles->setMotsCles("framework");

    //     $mots_cles2 = new MotsCles();
    //     $mots_cles2->setMotsCles("php");
        
    //     $marques_pages = new MarquePage();
    //     $marques_pages->setUrl("https://www.symfony.com/");
    //     $marques_pages->setDateCreation(new \DateTime());
    //     $marques_pages->setCommentaire("C'est un framework PHP très puissant et très pratique");
    //     $marques_pages->addMotsCle($mots_cles);
    //     $marques_pages->addMotsCle($mots_cles2);


    //     $entityManager->persist($mots_cles);
    //     $entityManager->persist($mots_cles2);
    //     $entityManager->persist($marques_pages);
    //     $entityManager->flush();

    //     return new Response("MarquePage sauvegardé avec l'id ". $marques_pages->getId());
    // }

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

    #[Route("/success", name:"success")]
    public function succes(EntityManagerInterface $entityManager)
    {
        return $this->render('marque_page/ajout_succes.html.twig');
    }
    
    #[Route("/ajout", name:"ajout")]
    public function ajoutMarquePage(Request $request, entityManagerInterface $entityManager)
    {
        // Création d’un objet Livre vierge
        $marque_page = new MarquePage();
        $form = $this->createForm(MarquePageType::class, $marque_page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $marque_page = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager->persist($marque_page);
            $entityManager->flush();
            return $this->redirectToRoute('marque_page_success');
        }
        return $this->render('marque_page/ajout.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route("/modifier/{id<\d+>}", name:"modifier")]
    public function modifierMarquePage(int $id, Request $request, entityManagerInterface $entityManager)
    {
        $marque_page = $entityManager->getRepository(MarquePage::class)->find($id);
        
        if (!$marque_page) {
            throw $this->createNotFoundException(
            "Aucun livre avec l'id ". $id
            );
        }
        
        $form = $this->createForm(MarquePageType::class, $marque_page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //die($marque_page);
            $entityManager->persist($marque_page);
            /*
            foreach ($marque_page->getMotsCles() as $mots_cles) {
                //$mots_cles->addLien($marque_page);
                $entityManager->persist($mots_cles);
            }
            */
            $entityManager->flush();
            return $this->redirectToRoute('marque_page_success');
        }
        
        return $this->render('marque_page/ajout.html.twig', [
            'form' => $form,
        ]);
    }
    
}
