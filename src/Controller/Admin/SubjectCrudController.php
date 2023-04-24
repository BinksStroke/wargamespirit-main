<?php

namespace App\Controller\Admin;

use App\Entity\Subject;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class SubjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subject::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // configuration de la page de création d'article sur le dashboard
        yield TextField::new('title');

        yield SlugField::new('slug')->setTargetFieldName('title');

        yield TextEditorField::new('content');

        yield TextField::new('featuredText');

        yield AssociationField::new('categories');

        yield DateTimeField::new('createdAt')
        // cacher sur les formulaires de création et d'édition
        ->hideOnForm();

        yield DateTimeField::new('updatedAt')
        // cacher sur les formulaires de création et d'édition
        ->hideOnForm();
    }
}
