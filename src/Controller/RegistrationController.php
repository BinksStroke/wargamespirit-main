<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{

    #[Route('/user/{email}', name: 'app_profile')]
    public function index(CategoryRepository $categoryRepo, User $user)
    {
        if(!$user) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'categories' => $categoryRepo->findAll()
        ]);
    }

    #[Route('/registration/register', name: 'app_register')]
    public function register(CategoryRepository $categoryRepo, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        // Si le formulaire est bon je gère l'inscription
        if ($form->isSubmitted() && $form->isValid()) {
            // hasher le mot de passe
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // envoie le mail si demander

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'categories' => $categoryRepo->findAll()
        ]);
    }
}
