<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Subject;
use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SubMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //On récupère l'url//
        $url = $this->adminUrlGenerator->setController(SubjectCrudController::class)
        ->generateUrl();
        //redirection vers l'url récupéré
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('UniversWargameSpirit'); 
    }

    public function configureMenuItems(): iterable
    {
        // configuration des menus du dashboard
        yield MenuItem::linkToRoute('Retour sur le site', 'fa fa-undo', 'app_home');

        yield MenuItem::subMenu('Sujets', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les sujets', 'fas fa-newspaper', Subject::class),
            // Création du sujet
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Subject::class)->setAction(Crud::PAGE_NEW),
            // Création des catégories
            MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class)
        ]);
        
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comment', Comment::class);
        
    }
}
