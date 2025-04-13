<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/se', name: 'se_connecter')]
    public function se_connecter(): Response
    {
        return $this->render('front/utilisateur/Login.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
