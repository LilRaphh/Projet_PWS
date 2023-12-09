<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Vin;
use App\Entity\Panier;
use App\Form\VinType;
use App\Repository\VinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vin')]
class VinController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    #[Route('/', name: 'app_vin_index', methods: ['GET'])]
    public function index(VinRepository $vinRepository): Response
    {
        return $this->render('vin/index.html.twig', [
            'vins' => $vinRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_vin_show', methods: ['GET'])]
    public function show(Vin $vin): Response
    {
        return $this->render('vin/show.html.twig', [
            'vin' => $vin,
        ]);
    }

}
