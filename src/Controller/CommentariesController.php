<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentariesRepository;
use App\Repository\UserRepository;
use App\Repository\ItemsRepository;
use App\Entity\Commentaries;
use App\Form\CommentariesFormType;

class CommentariesController extends AbstractController
{

    public function __construct(CommentariesRepository $commentariesRepository, UserRepository $userRepository, ItemsRepository $itemsRepository)
    {
        $this->commentariesRepository = $commentariesRepository;
        $this->userRepository = $userRepository;
        $this->itemsRepository = $itemsRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/commentaries/{itemID}/{userID}', name: 'add.comment')]
    public function addComment(Request $request, $itemID, $userID): Response
    {
       
           // $user = $this->userRepository->getOne($userID);
            $comment = new Commentaries();
            $form = $this->createForm(CommentariesFormType::class, $comment);
            $form->handleRequest($request);
            $item = $this->itemsRepository->getOne($itemID);
            $user = $this->userRepository->getOne($userID);
            if ($form->isSubmitted() && $form->isValid()) 
            {
                $msg = $form->get('message')->getData();
                if ($msg != null){
                    $this->commentariesRepository->addComment($comment,$msg,$user,$item);
                    $this->addFlash('success','Comment added');
                } else {
                    $this->addFlash('error','Comment not added');   
                }
            }
           // $allmsg = $this->commentariesRepository->getCommentaries($itemID);
            return $this->redirectToRoute('item.view',[
                'itemID' => $itemID
                
            ]);


        // return $this->render('commentaries/index.html.twig', [
        //     'controller_name' => 'CommentariesController',
        // ]);
    }
}
