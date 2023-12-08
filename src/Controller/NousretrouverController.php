<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NousretrouverController extends AbstractController
{
    #[Route('/nousretrouver', name: 'app_nousretrouver')]
    public function index(): Response
    {
        return $this->render('nousretrouver/index.html.twig', [
            'controller_name' => 'NousretrouverController',
        ]);
    }
}
