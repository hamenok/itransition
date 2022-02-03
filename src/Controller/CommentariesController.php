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
            return $this->redirectToRoute('item.view',[
                'itemID' => $itemID
            ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/profile/commentaries/', name: 'comment.view')]
    public function viewComment(Request $request, CommentariesRepository $commentariesRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
           $user = $this->getUser();
           
         
            $titlePage = "MY COMMENTARIES";

            $offset = max(0, $request->query->getInt('offset', 0));
            $paginator = $commentariesRepository->getMyCommentaries($user->getId(),$offset);

            return $this->render('commentaries/view.html.twig',[
                'titlePage' => $titlePage,
                'comments' => $paginator,
                'previous' => $offset - CommentariesRepository::PAGINATOR_PER_PAGE,
                'next' => min(count($paginator), $offset + CommentariesRepository::PAGINATOR_PER_PAGE)
            ]);
    }

    
}
