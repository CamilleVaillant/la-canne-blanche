<?php

namespace App\Controller;

use App\Entity\Tatoo;
use App\Form\TatooType;
use App\Form\TatooTypeForm;
use App\Form\TatooFilterTypeForm;
use App\Repository\TatooRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



final class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'app_gallery')]
    public function index(TatooRepository $tatooRepository, Request $request): Response
    {
        $form = $this->createForm(TatooFilterTypeForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $tatoos = $tatooRepository->filterTatoos($data);
        } else {
            $tatoos = $tatooRepository->findAll();
        }

        return $this->render('gallery/index.html.twig', [
            'form' => $form->createView(),
            'tatoos' => $tatoos,
        ]);
    }
    #[IsGranted('ROLE_USER')]
    #[Route('/tatoo/{id}', name: 'modify_tatoo')]
    #[Route('/tatoo', name: 'add_tatoo')]
    public function change(Tatoo $tatoo = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$tatoo) {
            $tatoo = new Tatoo();
        }

        $form = $this->createForm(TatooTypeForm::class, $tatoo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tatoo);
            $entityManager->flush();
            return $this->redirectToRoute('app_gallery');
        }

        return $this->render('gallery/addupdate.html.twig', [
            'tatooForm' => $form->createView(),
            'isModification' => $tatoo->getId() !== null,
            'tatoo' => $tatoo,
        ]);
    }

    #[Route('/tatoo/remove/{id}', name: 'delete_tatoo')]
    public function remove(Tatoo $tatoo, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('DEL' . $tatoo->getId(), $request->get('_token'))) {
            $entityManager->remove($tatoo);
            $entityManager->flush();
            $this->addFlash('success', 'Le tatouage a bien été supprimé.');
        }

        return $this->redirectToRoute('app_gallery');
    }

    



    
}





