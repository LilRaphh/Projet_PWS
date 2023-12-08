<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RejoignezNousController extends AbstractController
{
    #[Route('/rejoignez/nous', name: 'app_rejoignez_nous')]
    public function index(): Response
    {
        return $this->render('rejoignez_nous/index.html.twig', [
            'controller_name' => 'RejoignezNousController',
        ]);
    }
}
