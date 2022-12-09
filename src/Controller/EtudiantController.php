<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_add_etudiant')]
    #[Route('/etudiant/{id}/edit', name: 'edit_etudiant')]

    public function add(ManagerRegistry $doctrine, Etudiant $etudiant = null, Request $request): Response
    {
        //création d'un nouvel étudiant ou modification d'un existant
        if (!$etudiant){
            $etudiant = new Etudiant();
        }

        $etudiants = $doctrine->getRepository(Etudiant::class)->findBy([],["id"=>"DESC"]);
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $etudiant = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($etudiant);         //prepare
            $entityManager->flush();                    //execute

            return $this->redirectToRoute('app_etudiant');
        }
        //vue où afficher le formulaire
        return $this->render('etudiant/index.html.twig', [
            "etudiants" => $etudiants,
            'formAddEtudiant' => $form->createView()
        ]);
    }

    
    #[Route('/etudiant/{id}/delete', name: 'delete_etudiant')]
    //suppression d'un étudiant
    public function delete(ManagerRegistry $doctrine, Etudiant $etudiant){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($etudiant);
        $entityManager->flush();

        return $this->redirectToRoute('app_etudiant');
    }


    #[Route('/etudiant', name: 'app_etudiant')]
    
    public function index(ManagerRegistry $doctrine): Response
    {
        //cherche les etudiants dans la BDD, classé par nom
        $etudiants = $doctrine->getRepository(Etudiant::class)->findBy([], ["nom_etudiant" => "ASC"]);
        return $this->render('etudiant/index.html.twig', [
            'etudiants' => $etudiants
        ]);
    }
}
