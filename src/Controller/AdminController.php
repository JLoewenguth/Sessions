<?php

namespace App\Controller;

use App\Entity\Etudiant;
use Doctrine\DBAL\Types\TextType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    

    /*public function new(Request $request): Response
    {
        $etudiant = new Etudiant();
        $etudiant->setEtudiant('Ajouter un étudiant');

        $form = $this->createFormBuilder($etudiant)
            ->add('nomEtudiant', TextType::class)
            ->add('prenomEtudiant', TextType::class)
            ->add('emailEtudiant', TextType::class)
            ->add('phoneEtudiant', TextType::class);
            
    }*/
}
