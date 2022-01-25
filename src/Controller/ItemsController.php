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

class ItemsController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository, ItemsRepository $itemRepository)
    {
        $this->userRepository = $userRepository;
        $this->itemRepository = $itemRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/items', name: 'items')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();
        
        $items = $this->itemRepository->getAllMyItems($user->getId());
        $titlePage = 'MY ITEMS';
        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
            'titlePage'=>$titlePage,
            'items'=>$items
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

            // if ($form->get('delete')->isClicked())
            // {
            //     if ($item->getImageItems()!='no-item-photo.png' && $item->getImageItems()!=null){
            //         $fileManagerService->imagePhotoRemove($user->getAvatar(), 'user');
            //         $item->setImageItems('no-item-photo.png');
            //         $this->addFlash('photo.delete','Photo was deleted');
            //         return $this->redirectToRoute('profile.edit',['id'=>$id]);
            //     } else {
            //         $this->addFlash('photo.not.delete','Photo not was deleted');
            //         return $this->redirectToRoute('profile.edit',['id'=>$id]);
            //     }
            // }
            $this->addFlash('success','Item added');
            $this->itemRepository->setCreateItem($item,$user);
            return $this->redirectToRoute('items.add',['userID'=>$userID]);
        }


        $titlePage = 'ADD ITEMS';
        return $this->render('items/add.html.twig', [
            'controller_name' => 'ItemsController',
            'titlePage'=>$titlePage,
            'addItemsForm' => $form->createView(),
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/items/item/{itemid}', name: 'item.view')]
    public function viewItem($itemid): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->getUser();
        
        $items = $this->itemRepository->getAllMyItems($user->getId());
        $titlePage = 'MY ITEMS';
        return $this->render('items/index.html.twig', [
            'controller_name' => 'ItemsController',
            'titlePage'=>$titlePage,
            'items'=>$items
        ]);
    }
}
