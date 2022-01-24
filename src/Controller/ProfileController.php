<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use App\Form\EditProfileFormType;
use App\Form\ChangePasswordFormType;
use App\Service\FileManagerServiceInterface;

class ProfileController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/{_locale<%app.supported_locales%>}/profile/{id}', name: 'profile')]
    public function viewProfile(ManagerRegistry $doctrine, $id)
    {
        $titlePage = 'VIEW PROFILE';
        $user = $this->userRepository->getOne($id);

        return $this->render('profile/show.html.twig',[
            'user' => $user,
            'titlePage' => $titlePage,
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/profile/edit/{id}', name: 'profile.edit')]
    public function editProfile( ManagerRegistry $doctrine, Request $request, $id, FileManagerServiceInterface $fileManagerService)
    {

        $user = $this->userRepository->getOne($id);
   
       /* $user->setFirstname($request->get('firstname'));
        $user->setLastname($request->get('lastname'));
        $doctrine->getManager()->flush();


        $user = new User();
        */
        $form = $this->createForm(EditProfileFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $image = $form->get('avatar')->getData();
            if ($image != null){
                $fileName = $fileManagerService->imagePhotoUpload($image);
                $user->setAvatar($fileName);
            } else {
                $user->setAvatar($form->get('avatar_')->getData());
            }
            //$doctrine->getManager()->flush();
            $this->userRepository->setUpdateUser($user);
            return $this->redirectToRoute('profile',['id'=>$id]);
        }
        $titlePage = 'EDIT PROFILE';

        return $this->render('profile/edit.html.twig',[
            'user' => $user,
            'titlePage' => $titlePage,
            'editProfileForm' => $form->createView(),
        ]);
    }

    #[Route('/{_locale<%app.supported_locales%>}/profile/password/{id}', name: 'profile.password')]
    public function changePassword(Request $request, $id)
    {
        $titlePage = 'CHANGE PASSWORD';
        $user = $this->userRepository->getOne($id);
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $newPassword = $form->get('plainPassword')->getData();
            $againPassword = $form->get('plainPasswordAgain')->getData();
            if ($newPassword == $againPassword){
                $this->addFlash('success','Password changed');
               // return $this->redirectToRoute('profile',['id'=>$id]);
               $this->userRepository->upgradePassword($user, $newPassword);
            } else {
                $this->addFlash('error','Password not updated');
            }
            //$doctrine->getManager()->flush();
            //$this->userRepository->setUpdateUser($user);
            
        }
       // $this->userRepository->upgradePassword($user, '321321321');
        //$this->userRepository->setUpdateUser($user);
        return $this->render('profile/shangepassword.html.twig', [
            'titlePage' => $titlePage,
            'changepasswordform' => $form->createView(),

        ]);
    }

}
