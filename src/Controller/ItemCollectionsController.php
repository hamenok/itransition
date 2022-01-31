<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ItemCollections;
use App\Form\ItemCollectionsFormType;
use App\Repository\UserRepository;
use App\Repository\ItemCollectionsRepository;

class ItemCollectionsController extends AbstractController
{
    public function __construct(UserRepository $userRepository, ItemCollectionsRepository $itemCollectionsRepository)
    {
        $this->userRepository = $userRepository;
        $this->itemCollectionsRepository = $itemCollectionsRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/collection/add', name: 'collection.add')]
    public function addCollection(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();
        $collection = new ItemCollections();
        $form = $this->createForm(ItemCollectionsFormType::class, $collection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $this->addFlash('success','Collection added');
            $this->itemCollectionsRepository->setCreateCollection($collection,$user);
            return $this->redirectToRoute('collection.add');
        }
        $titlePage = "ADD COLLECTION";

        return $this->render('item_collections/add.html.twig', [
            'controller_name' => 'ItemCollectionsController',
            
            'addCollection' => $form->createView(),
            'titlePage' => $titlePage
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/profile/collection', name: 'collection.my')]
    public function myCollection(Request $request): Response
    {
        $user = $this->getUser();
        
        $collections = $this->itemCollectionsRepository->getAllMyCollection($user->getId());
        $titlePage = 'MY COLLECTIONS';
        return $this->render('item_collections/view.html.twig', [
            'controller_name' => 'ItemCollectionsController',
            'titlePage'=>$titlePage,
            'collections'=>$collections
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/collections/collection/{collectionID}', name: 'collection.view')]
    public function viewCollection($collectionID): Response
    {
        $user = $this->getUser();
        
        $collection = $this->itemCollectionsRepository->getOne($collectionID);
        $titlePage = 'COLLECTION';
        return $this->render('item_collections/more_view.html.twig', [
            'controller_name' => 'ItemCollectionsController',
            'titlePage'=>$titlePage,
            'collection'=>$collection
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/collections/collections/remove/{collectionID}', name: 'collection.remove')]
    public function removeCollection($collectionID): Response
    {
        $collection = $this->itemCollectionsRepository->getOneId($collectionID);
        $this->itemCollectionsRepository->removeItems($collection);
       
        return $this->redirectToRoute('collection.my');
    }


}
