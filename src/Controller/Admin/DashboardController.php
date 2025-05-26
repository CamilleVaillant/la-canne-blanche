<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Tatoo;
use App\Entity\Illustration;
use Vich\UploaderBundle\Entity\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    
    public function index(): Response
    {
         return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('La Canne Blanche');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute('Quitter l\'admin', 'fa-solid fa-sign-out-alt', 'app_home');
        yield MenuItem::linkToCrud('Les Tatoo', 'fa-solid fa-wine-bottle', Tatoo::class);
        yield MenuItem::linkToCrud('les Styles','fa-solid fa-leaf', Type::class);
        yield MenuItem::linkToCrud('les image','fa-solid fa-earth-europe', File::class);
        yield MenuItem::linkToCrud('les Illustration','fa-regular fa-map', Illustration::class);
        yield MenuItem::linkToCrud('les Tatoueurs','fa-regular fa-user', User::class);
        
    }
}
