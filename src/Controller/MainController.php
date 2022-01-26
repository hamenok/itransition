<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ItemsRepository;

class MainController extends AbstractController
{
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
    public function index(Request $request, ItemsRepository $itemsRepository): Response
    { 
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $itemsRepository->getAllItemsPaginator($offset);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'items' => $paginator,
            'previous' => $offset - ItemsRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ItemsRepository::PAGINATOR_PER_PAGE)
        ]);
    }



}
