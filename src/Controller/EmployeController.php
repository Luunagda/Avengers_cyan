<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Employe;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Type\EmployeType;
use App\Form\Type\AdresseType;


#[Route("/employe", requirements: ["_locale" => "en|es|fr"], name: "employe_")]
class EmployeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $employes = $entityManager->getRepository(Employe::class)->findAll();

        return $this->render('employe/index.html.twig', [
            'controller_name' => 'EmployeController',
            'employes' => $employes,
        ]);
    }

    #[Route("/detail/{id<\d+>}", name: "detail")]
    public function afficherEmploye(int $id, EntityManagerInterface $entityManager):Response
    {
        $employe = $entityManager->getRepository(Employe::class)->find($id);
        if (!$employe) {
            throw $this->createNotFoundException(
            "Aucun employé avec l'id ". $id
            );
        }
        return $this->render('employe/detail.html.twig', [
            'employe' => $employe,
        ]);
    }

    #[Route("/success", name:"succes")]
    public function succes(EntityManagerInterface $entityManager)
    {
        return $this->render('employe/ajout_succes.html.twig');
    }

    #[Route("/ajout", name:"ajout")]
    public function ajoutEmploye(Request $request, entityManagerInterface $entityManager)
    {
        // Création d’un objet employe vierge
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() : pour récupérer les données
            // Les données sont déjà stockées dans la variable d’origine
            // $employe = $form->getData();
            // ... Effectuer le/les traitements(s) à réaliser
            // Par exemple :
            $entityManager->persist($employe);
            $entityManager->flush();
            return $this->redirectToRoute('employe_succes');
        }
        return $this->render('employe/ajout.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route("/modifier/{id<\d+>}", name:"modifier")]
    public function modifierEmploye(int $id, Request $request, entityManagerInterface $entityManager)
    {
        $employe = $entityManager->getRepository(Employe::class)->find($id);
        
        if (!$employe) {
            throw $this->createNotFoundException(
            "Aucun employé avec l'id ". $id
            );
        }
        
        $form = $this->createForm(EmployeType::class, $employe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($employe);
            $entityManager->flush();
            return $this->redirectToRoute('employe_succes');
        }
        
        return $this->render('employe/ajout.html.twig', [
            'form' => $form,
        ]);
    }
}
