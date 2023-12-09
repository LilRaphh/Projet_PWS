<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\PanierQte;
use App\Entity\Vin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'app_panier_show', methods: ['GET'])]
    public function index(Security $security): Response
    {
        $user = $security->getUser();

        return $this->render('panier/show.html.twig', [
            'qtes' => $user->getPanier()->getPanierQtes(),
        ]);
    }

    #[Route('/add/{id}', name: 'app_panier_add', methods: ['GET', 'POST'])]
    public function ajouterAuPanier(Security $security, Vin $vin, EntityManagerInterface $entityManager): Response
    {
        $user = $security->getUser();
        $panier = $user->getPanier();

        if (!$panier->hasPanierQte($vin)) {
            $panierQte = new PanierQte();
            $panierQte->setPanier($panier);
            $panierQte->setVin($vin);
            $panierQte->setQuantite(1);

            $vin->setQuantitestock($vin->getQuantitestock() - 1);
            $panier->addPanierQte($panierQte);
            $entityManager->persist($panier);
        } else {
            $panierQte = $panier->getPanierQte($vin);

            $panierQte->setQuantite($panierQte->getQuantite() + 1);
            $vin->setQuantitestock($vin->getQuantitestock() - 1);
        }

        $entityManager->persist($vin);
        $entityManager->persist($panierQte);
        $entityManager->flush();

        return $this->redirectToRoute('app_panier_show', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/remove/{id}', name: 'app_panier_remove', methods: ['GET', 'POST'])]
    public function retirerDuPanier(Security $security, Vin $vin, EntityManagerInterface $entityManager): Response
    {
        $user = $security->getUser();
        $panier = $user->getPanier();
        $panierQte = $panier->getPanierQte($vin);

        if ($panierQte->getQuantite() == 1) {
            return $this->redirectToRoute('app_panier_delete', ['id' => $vin->getId()], Response::HTTP_SEE_OTHER);
        }

        $panierQte->setQuantite($panierQte->getQuantite() - 1);
        $vin->setQuantitestock($vin->getQuantitestock() + 1);

        $entityManager->persist($vin);
        $entityManager->persist($panierQte);
        $entityManager->flush();

        return $this->redirectToRoute('app_panier_show', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/{id}', name: 'app_panier_delete', methods: ['GET', 'POST'])]
    public function supprimerDuPanier(Security $security, Vin $vin, EntityManagerInterface $entityManager): Response
    {
        $user = $security->getUser();
        $panier = $user->getPanier();

        $panierQte = $panier->getPanierQte($vin);
        $vin->setQuantitestock($vin->getQuantitestock() + $panierQte->getQuantite());
        $panier->removePanierQte($panierQte);


        $entityManager->persist($panier);
        $entityManager->persist($vin);
        $entityManager->remove($panierQte);
        $entityManager->flush();

        return $this->redirectToRoute('app_panier_show', [], Response::HTTP_SEE_OTHER);
    }
}
