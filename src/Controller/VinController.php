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

    #[Route('/new', name: 'app_vin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vin = new Vin();
        $form = $this->createForm(VinType::class, $vin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vin);
            $entityManager->flush();

            return $this->redirectToRoute('app_vin_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vin/new.html.twig', [
            'vin' => $vin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vin_show', methods: ['GET'])]
    public function show(Vin $vin): Response
    {
        return $this->render('vin/show.html.twig', [
            'vin' => $vin,
        ]);
    }

    #[Route('/{id}/add', name: 'app_vin_ajouterPanier', methods: ['GET'])]
    public function ajouterPanier(Vin $vin, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->security->getUser();
        $panier = $user->getPanier();

        $panier -> addVin($vin);
        $entityManager->persist($panier);
        $entityManager->flush();
        return $this->render('panier/show.html.twig', [
            'panier' => $panier,
        ]);
    }






    #[Route('/{id}', name: 'app_vin_delete', methods: ['POST'])]
    public function delete(Request $request, Vin $vin, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vin->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vin_index', [], Response::HTTP_SEE_OTHER);
    }
}
