<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\ItemsRepository;
use App\Entity\Items;
use App\Form\ItemsFormType;
use App\Service\FileManagerServiceInterface;
use App\Repository\CommentariesRepository;
use App\Entity\Commentaries;
use App\Form\CommentariesFormType;
use App\Entity\CollectionsFull;
use App\Form\CollectionsFullFormType;
use App\Repository\CollectionsFullRepository;
use App\Repository\LikeItemRepository;
use App\Repository\ItemCollectionsRepository;
class ItemsController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository, ItemsRepository $itemRepository, 
                                CommentariesRepository $commentariesRepository, LikeItemRepository $likeItemRepository, 
                                CollectionsFullRepository $collectionsFullRepository, ItemCollectionsRepository $itemCollectionsRepository)
    {
        $this->userRepository = $userRepository;
        $this->itemRepository = $itemRepository;
        $this->commentariesRepository = $commentariesRepository;
        $this->likeItemRepository = $likeItemRepository;
        $this->collectionsFullRepository = $collectionsFullRepository;
        $this->itemCollectionsRepository = $itemCollectionsRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/items', name: 'items')]
    public function index(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();
        $collectionsFull = new CollectionsFull();
        $form = $this->createForm(CollectionsFullFormType::class, $collectionsFull);
        $form->handleRequest($request);
       
        $userID = $this->userRepository->getOne($user->getId());
        
        
        if ($form->isSubmitted() && $form->isValid()) 
        {
        
            $itemID = $this->itemRepository->getOne($request->get('itemID'));
        $collectionsFull->setCollectionID($form->get('collectionID')->getData());
        $collectionsFull->setUserID($userID);
        $collectionsFull->setItemID($itemID);
        $this->collectionsFullRepository->setCreateCollection($collectionsFull);
        }
        $items = $this->itemRepository->getAllMyItems($user->getId());
        $titlePage = 'MY ITEMS';
        return $this->render('items/index.html.twig', [
            'titlePage'=>$titlePage,
            'items'=>$items,
            'addCollectionsFull' => $form->createView()
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/items/add/{userID}', name: 'items.add')]
    public function addItem(Request $request, FileManagerServiceInterface $fileManagerService, $userID): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->userRepository->getOne($userID);
        $item = new Items();
        $form = $this->createForm(ItemsFormType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $image = $form->get('imageItems')->getData();
            if ($image != null){
                $fileName = $fileManagerService->imagePhotoUpload($image, 'item');
                $item->setImageItems($fileName);
            } else {
                $item->setImageItems('no-item-photo.png');
            }

            
            $this->addFlash('success','Item added');
            $this->itemRepository->setCreateItem($item,$user);
            return $this->redirectToRoute('items.add',['userID'=>$userID]);
        }


        $titlePage = 'ADD ITEMS';
        return $this->render('items/add.html.twig', [
            'titlePage'=>$titlePage,
            'addItemsForm' => $form->createView()
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/items/item/{itemID}', name: 'item.view')]
    public function viewItem($itemID): Response
    {
        $items = $this->itemRepository->getItemAndAutor($itemID);

        $comment = new Commentaries();
        $form = $this->createForm(CommentariesFormType::class, $comment);
        $allmsg = $this->commentariesRepository->getCommentaries($itemID);
        $allLike = $this->likeItemRepository->getAllLike($itemID);
        return $this->render('items/view.html.twig', [
            'addComment' => $form->createView(),
            'items'=>$items,
            'allmsg' => $allmsg,
            'likes' => count($allLike)
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/items/item/remove/{itemID}', name: 'item.remove')]
    public function removeItem($itemID): Response
    {
        $item = $this->itemRepository->getOne($itemID);
        $this->itemRepository->removeItems($item);
       
        return $this->redirectToRoute('items');
    }
}
