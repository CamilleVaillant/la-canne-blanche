<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TeamController extends AbstractController
{
    #[Route('/team', name: 'app_team')]
    public function index( UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        return $this->render('team/index.html.twig', [
            'tatoueurs' => $user,
        ]);
    }
}
