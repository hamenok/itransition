<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\ItemsRepository;
use App\Repository\LikeItemRepository;
use App\Entity\LikeItem;

class LikeController extends AbstractController
{
    public function __construct(LikeItemRepository $likeItemRepository, UserRepository $userRepository, ItemsRepository $itemsRepository)
    {
        $this->likeItemRepository = $likeItemRepository;
        $this->userRepository = $userRepository;
        $this->itemsRepository = $itemsRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/like/{itemID}/{userID}', name: 'like')]
    public function addLike($itemID, $userID): Response
    {

        $like = new LikeItem();
        $item = $this->itemsRepository->getOne($itemID);
        $user = $this->userRepository->getOne($userID);
        $getLike = $this->likeItemRepository->getLikeUser($itemID,$userID);
        if (count($getLike)<1)
        {
            $this->likeItemRepository->addLike($like,$user, $item);
        } else {
            $this->likeItemRepository->delLike($this->likeItemRepository->getOne($getLike[0]['id']));
        }
     
        return $this->redirectToRoute('item.view',[
            'itemID' => $itemID
            
        ]);
    }

}