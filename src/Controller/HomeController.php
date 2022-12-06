<?php

namespace App\Controller;

use App\Entity\Session;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    
    public function index(ManagerRegistry $doctrine): Response
    {
        //cherche les sessions dans la BDD, classé par date
        $sessions = $doctrine->getRepository(Session::class)->findBy([], ["date_debut" => "ASC"]);
        return $this->render('home/index.html.twig', [
            'sessions' => $sessions
        ]);
    }
    
}
