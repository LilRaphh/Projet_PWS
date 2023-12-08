<?php

namespace App\Controller;

use App\Entity\Recrutement;
use App\Form\RecrutementType;
use App\Repository\RecrutementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/recrutement')]
class RecrutementController extends AbstractController
{
    #[Route('/', name: 'app_recrutement_index', methods: ['GET'])]
    public function index(RecrutementRepository $recrutementRepository): Response
    {
        return $this->render('recrutement/index.html.twig', [
            'recrutements' => $recrutementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_recrutement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recrutement = new Recrutement();
        $form = $this->createForm(RecrutementType::class, $recrutement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cv = $form->get('cv')->getData();
            $lettremotivation = $form->get('lettre de motivation')->getData();

             // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($cv) {
                $originalFilename = pathinfo($cv->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$cv->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $cv->move(
                        $this->getParameter('cv_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $recrutement->setcvFilename($newFilename);
            }

            if ($lettremotivation) {
                $originalFilename = pathinfo($lettremotivation->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$lettremotivation->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $lettremotivation->move(
                        $this->getParameter('lettremotivation_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $recrutement->setlettremotivationFilename($newFilename);
            }

            // ... persist the $product variable or any other work

            $entityManager->persist($recrutement);
            $entityManager->flush();

            return $this->redirectToRoute('app_recrutement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recrutement/new.html.twig', [
            'recrutement' => $recrutement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recrutement_show', methods: ['GET'])]
    public function show(Recrutement $recrutement): Response
    {
        return $this->render('recrutement/show.html.twig', [
            'recrutement' => $recrutement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_recrutement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recrutement $recrutement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecrutementType::class, $recrutement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recrutement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recrutement/edit.html.twig', [
            'recrutement' => $recrutement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_recrutement_delete', methods: ['POST'])]
    public function delete(Request $request, Recrutement $recrutement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recrutement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recrutement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_recrutement_index', [], Response::HTTP_SEE_OTHER);
    }
}
