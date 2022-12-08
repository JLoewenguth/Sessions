<?php

namespace App\Controller;

use App\Entity\Session;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_add_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]

    public function add(ManagerRegistry $doctrine, Session $session = null, Request $request): Response
    {
        //création d'une nouvelle session ou modification d'un existant
        if (!$session){
            $session = new Session();
        }

        $sessions = $doctrine->getRepository(Session::class)->findBy([],["id"=>"DESC"]);
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $session = $form->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($session);         //prepare
            $entityManager->flush();                    //execute

            return $this->redirectToRoute('app_session');
        }
        //vue où afficher le formulaire
        return $this->render('session/index.html.twig', [
            "sessions" => $sessions,
            'formAddSession' => $form->createView()
        ]);
    }

    
    #[Route('/session/{id}/delete', name: 'delete_session')]
    //suppression d'une session
    public function delete(ManagerRegistry $doctrine, Session $session){
        $entityManager = $doctrine->getManager();
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session');
    }

    #[Route('/session', name: 'app_session')]
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
