<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

// CommentType hérite de toutes le fonctions de AbstractType
class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ajout des champs dont on va ce servir pour le commentaire
        $builder
            ->add('user', EmailType::class, [
                'label' => 'E-mail', 
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre commentaire', 
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        
            ->add('Publier', SubmitType::class);
    }
}
