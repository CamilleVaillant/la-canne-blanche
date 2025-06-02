<?php

namespace App\Controller;

use Symfony\Component\Uid\Uuid;
use App\Form\SendNewWordPassType;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use App\Form\ModifyTheWordPassType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class ResetPasswordController extends AbstractController
{
    #[Route('/reset/password', name: 'app_request_reset_password')]
    public function request(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
    ): Response {
        $form = $this->createForm(SendNewWordPassType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userEmail = $form->get('email')->getData();
            $user = $userRepository->findOneBy(['email' => $userEmail]);

            if ($user) {
                $token = Uuid::v4()->toRfc4122();
                $user->setResetToken($token);
                $user->setResetTokenExpiresAt((new \DateTime())->modify('+1 hour'));
                $entityManager->flush();

                $resetLink = $this->generateUrl(
                    'app_modify_the_word_pass',
                    ['token' => $token],
                    UrlGeneratorInterface::ABSOLUTE_URL
                );

                $emailMessage = (new Email())
                    ->from('noreply@yourdomain.com')
                    ->to($user->getEmail())
                    ->subject('Réinitialisation de votre mot de passe')
                    ->text("Voici votre lien de réinitialisation : $resetLink");

                $mailer->send($emailMessage);

                $this->addFlash('success', 'Un email de réinitialisation a été envoyé.');
                return $this->redirectToRoute('app_login');
            }

            $this->addFlash('error', 'Aucun utilisateur trouvé pour cet email.');
        }

        return $this->render('send_new_word_pass/index.html.twig', [
            'requestForm' => $form->createView(),
        ]);
    }

    #[Route('/reset-password/{token}', name: 'app_modify_the_word_pass')]
    public function reset(
        string $token,
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $user = $userRepository->findOneBy(['resetToken' => $token]);

        if (!$user || !$user->isResetTokenValid()) {
            $this->addFlash('danger', 'Ce lien de réinitialisation est invalide ou expiré.');
            return $this->redirectToRoute('app_request_reset_password');
        }

        $form = $this->createForm(ModifyTheWordPassType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newPassword = $form->get('plainPassword')->getData();
            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);

            $user->setPassword($hashedPassword);
            $user->setResetToken(null);
            $user->setResetTokenExpiresAt(null);
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a été mis à jour avec succès.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('modify_the_word_pass/index.html.twig', [
            'resetForm' => $form->createView(),
        ]);
    }
}
