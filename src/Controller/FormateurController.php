<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Form\FormateurType;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class FormateurController extends AbstractController
{
    #[Route('/formateur', name: 'app_add_formateur')]
    #[Route('/formateur/{id}/edit', name: 'edit_formateur')]

    public function add(ManagerRegistry $doctrine, Formateur $formateur = null, Request $request): Response
    {
        //création d'un nouvel formateur ou modification d'un existant
        if (!$formateur){
            $formateur = new Formateur();
        }

        $formateurs = $doctrine->getRepository(Formateur::class)->findBy([],["id"=>"DESC"]);
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $formateur = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($formateur);         //prepare
            $entityManager->flush();                    //execute

            return $this->redirectToRoute('app_formateur');
        }
        //vue où afficher le formulaire
        return $this->render('formateur/index.html.twig', [
            "formateurs" => $formateurs,
            'formAddFormateur' => $form->createView()
        ]);
    }

    
    #[Route('/formateur/{id}/delete', name: 'delete_formateur')]
    //suppression d'un formateur
    public function delete(ManagerRegistry $doctrine, Formateur $formateur){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($formateur);
        $entityManager->flush();

        return $this->redirectToRoute('app_formateur');
    }


    #[Route('/formateur', name: 'app_formateur')]
    public function index(): Response
    {
        return $this->render('formateur/index.html.twig', [
            'controller_name' => 'FormateurController',
        ]);
    }
}
