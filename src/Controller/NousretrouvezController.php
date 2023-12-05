<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NousretrouvezController extends AbstractController
{
    #[Route('/nousretrouvez', name: 'app_nousretrouvez')]
    public function index(): Response
    {
        return $this->render('nousretrouvez/index.html.twig', [
            'controller_name' => 'NousretrouvezController',
        ]);
    }
}
