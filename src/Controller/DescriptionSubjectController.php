<?php

namespace App\Controller;


use App\Entity\Subject;
use App\Entity\Comment;
use App\Entity\User;

use App\Repository\CategoryRepository;
use App\Form\Type\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DescriptionSubjectController extends AbstractController
{
    #[Route('/description/subject/{slug}', name: 'app_description_subject')]
    public function show(?Subject $subject, CategoryRepository $categoryRepo, Request $request): Response
    {
        if (!$subject) {
            return $this->redirectToRoute('app_home');
        }


        
        // Partie commentaire
        // On crée le commentaire vierge
        $comment = new Comment($subject);   

        // On genère le commentaire
        $commentForm = $this->createForm(CommentType::class, $comment);

        // $commentForm->handleRequest($request);
        if ($commentForm->isSubmitted() && $commentForm->isValid()){
            $user = $this->getUser();
            dd($comment);


        }

        return $this->renderForm('description_subject/show.html.twig', [
            'subject' => $subject,
            'commentForm' => $commentForm,
            'categories' => $categoryRepo->findAll()  
        ]);
    }
}
