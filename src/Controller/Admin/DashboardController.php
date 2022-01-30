<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Role;
use App\Entity\Items;
use App\Entity\Category;
use App\Entity\Commentaries;
use App\Repository\UserRepository;
use App\Repository\ItemsRepository;
use App\Repository\LikeItemRepository;
use App\Repository\CommentariesRepository;

class DashboardController extends AbstractDashboardController
{
    public function __construct(UserRepository $userRepository, ItemsRepository $itemRepository, CommentariesRepository $commentariesRepository, LikeItemRepository $likeItemRepository)
    {
        $this->userRepository = $userRepository;
        $this->itemRepository = $itemRepository;
        $this->commentariesRepository = $commentariesRepository;
        $this->likeItemRepository = $likeItemRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/admin', name: 'admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
       
        $allUsersCount = $this->userRepository->getAll();
        $allItemsCount = $this->itemRepository->getAll();
        $allCommentariesCount = $this->commentariesRepository->getAll();
        $allLikesCount = $this->likeItemRepository->getAll();

         return $this->render('admpanel/index.html.twig',[
             'allUsersCount' => count($allUsersCount),
             'allItemsCount' => count($allItemsCount),
             'allCommentariesCount' => count($allCommentariesCount),
             'allLikesCount' => count($allLikesCount)
         ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        // the name visible to end users
        ->setTitle('ADMIN PANEL')
        // you can include HTML contents too (e.g. to link to an image)
       

     

        // there's no need to define the "text direction" explicitly because
        // its default value is inferred dynamically from the user locale
     

        // set this option if you prefer the page content to span the entire
        // browser width, instead of the default design which sets a max width
        ->renderContentMaximized()

        // set this option if you prefer the sidebar (which contains the main menu)
        // to be displayed as a narrow column instead of the default expanded design
        //->renderSidebarMinimized()

        // by default, all backend URLs include a signature hash. If a user changes any
        // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
        // triggers an error. If this causes any issue in your backend, call this method
        // to disable this feature and remove all URL signature checks
        ->disableUrlSignatures()

        // by default, all backend URLs are generated as absolute URLs. If you
        // need to generate relative URLs instead, call this method
        ->generateRelativeUrls()
    ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToRoute('HOME','fa fa-home', 'home' ),

            MenuItem::section('USERS'),
                MenuItem::linkToCrud('User', 'fa fa-user-o', User::class),
                MenuItem::linkToCrud('Role', 'fa fa-lock', Role::class),

            MenuItem::section('ITEMS'),
                MenuItem::linkToCrud('Items', 'fa fa-tags', Items::class),
                MenuItem::linkToCrud('Commentaries', 'fa fa-commenting-o', Commentaries::class),

            MenuItem::section('COLLECTIONS'),
                MenuItem::linkToCrud('Category','fa fa-bookmark', Category::class)

        ];
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        if ($this->getUser()->getAvatar()) {
            $ava = '/images/users/'.$this->getUser()->getAvatar();
        } else {
            $ava = '';
        }
        return parent::configureUserMenu($user)
            ->setAvatarUrl($ava)
            ->setName($this->getUser()->getEmail());
    }
    
}
