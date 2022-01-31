<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ItemsRepository;
use App\Repository\ItemCollectionsRepository;

class MainController extends AbstractController
{

    public function __construct(ItemCollectionsRepository $itemCollectionsRepository)
    {
        $this->itemCollectionsRepository = $itemCollectionsRepository;
    }

    #[Route('/')]
    public function indexNoLocale(Request $request): Response
    {
        if ($request->cookies->get('userLocale')){
            $cookie = $request->cookies->get('userLocale');
        } else {
            $cookie = 'en';
        }
        return $this->redirectToRoute('home', ['_locale' => $cookie]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/', name: 'home')]
    public function index(Request $request, ItemsRepository $itemsRepository, ItemCollectionsRepository $itemCollectionsRepository): Response
    { 
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $itemsRepository->getAllItemsPaginator($offset);

        $collections = $this->itemCollectionsRepository->getAllCollection();

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'items' => $paginator,
            'previous' => $offset - ItemsRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ItemsRepository::PAGINATOR_PER_PAGE),
            'collections' => $collections
        ]);
    }



}
