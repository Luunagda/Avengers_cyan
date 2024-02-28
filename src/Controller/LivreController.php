<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Livre;
use App\Entity\Auteur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\LivreType;
use App\Form\Type\AuteurType;


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
    
    // #[Route("/ajouter", name: "ajouter")]
    // public function ajouterLivre(EntityManagerInterface $entityManager): Response
    // {
    //     $auteur = new Auteur();
    //     $auteur->setPrenom("V.E.");
    //     $auteur->setNom("Schwab");
        
    //     $livre = new Livre();
    //     $livre->setTitre("Vicious");
    //     $livre->setAnnee(2019);
    //     $livre->setNbPages(532);
    //     $livre->setAuteur($auteur);

    //     $entityManager->persist($auteur);
    //     $entityManager->persist($livre);
    //     $entityManager->flush();

    //     return new Response("Livre sauvegardé avec l'id ". $livre->getId());
    // }

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

    
    #[Route("/recherche/lettre-debut/{lettre}", name:"lettre")]
    public function lettre($lettre, EntityManagerInterface $entityManager)
    {
        $listeLivres = $entityManager
        ->getRepository(Livre::class)
        ->getStartBy($lettre);
        return $this->render('livre/index.html.twig', [
            'livre' => $listeLivres,
        ]);
    }

    #[Route("/recherche/auteur/{nbLivre}", name:"nb_livre_auteur")]
    public function auteurPlusieursLivre($nbLivre, EntityManagerInterface $entityManager)
    {
        $listeLivres = $entityManager
        ->getRepository(Livre::class)
        ->FindAuteurByNbLivre($nbLivre);
        return $this->render('livre/auteur.html.twig', [
            'auteur' => $listeLivres,
        ]);
    }

    #[Route("/recherche/nb-livre", name:"nb_livre")]
    public function nbLivre(EntityManagerInterface $entityManager)
    {
        $nbLivre = $entityManager
        ->getRepository(Livre::class)
        ->getNbLivres();
        return $this->render('livre/count.html.twig', [
            'nbLivre' => $nbLivre,
        ]);
    }

    #[Route("/success", name:"succes")]
    public function succes(EntityManagerInterface $entityManager)
    {
        return $this->render('livre/ajout_succes.html.twig');
    }


    #[Route("/ajout", name:"ajout")]
    public function ajoutLivre(Request $request, entityManagerInterface $entityManager)
    {
        // Création d’un objet Livre vierge
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $livre = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager->persist($livre);
            $entityManager->flush();
            return $this->redirectToRoute('livre_succes');
        }
        return $this->render('livre/ajout.html.twig', [
            'form' => $form,
        ]);
    }
    
    #[Route("/auteur/ajout", name:"ajout")]
    public function ajoutAuteur(Request $request, entityManagerInterface $entityManager)
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $auteur = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('livre_succes');
        }
        return $this->render('livre/ajout.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route("/auteur/modifier/{id<\d+>}", name:"modifier_auteur")]
    public function modifierAuteur(int $id, Request $request, entityManagerInterface $entityManager)
    {
        $auteur = $entityManager->getRepository(Auteur::class)->find($id);
        
        if (!$auteur) {
            throw $this->createNotFoundException(
            "Aucun auteur avec l'id ". $id
            );
        }

        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $auteur = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager->persist($auteur);
            $entityManager->flush();
            return $this->redirectToRoute('livre_succes');
        }
        
        return $this->render('livre/ajout.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route("/modifier/{id<\d+>}", name:"modifier_livre")]
    public function modifierLivre(int $id, Request $request, entityManagerInterface $entityManager)
    {
        $livre = $entityManager->getRepository(Livre::class)->find($id);
        
        if (!$livre) {
            throw $this->createNotFoundException(
            "Aucun livre avec l'id ". $id
            );
        }
        
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($livre);
            $entityManager->flush();
            return $this->redirectToRoute('livre_succes');
        }
        
        return $this->render('livre/ajout.html.twig', [
            'form' => $form,
        ]);
    }
}




