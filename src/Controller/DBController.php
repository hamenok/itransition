<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class DBController extends AbstractController
{
    #[Route('/db/users', name: 'users')]
    public function getusersAction(ManagerRegistry $doctrine) : Response
    {
        
        $users = $doctrine->getRepository(Users::class)->findAll();

        return $this->render('users/show.html.twig', ['users'=>$users]);
        
    }

    #[Route('/db/edituser/{id}', name: 'edit.user', methods: 'get')]
    public function adduserAction(ManagerRegistry $doctrine, $id)
    {
        $user = $doctrine->getRepository(Users::class)->findOneBy(['idusers' => $id]);

        return $this->render('users/edit.html.twig',['user' => $user]);
    }

    #[Route('/db/edituser/{id}', name: 'save.user', methods: 'post')]
    public function saveuserAction(ManagerRegistry $doctrine, $id, Request $request)
    {
        $user = $doctrine->getRepository(Users::class)->findOneBy(['idusers' => $id]);
        $user->setFirstname($request->get('firstname'));
        $user->setLastname($request->get('lastname'));
        $doctrine->getManager()->flush();

        return $this->redirect('/db/users/');
    }

    #[Route('/db/deleteuser/{id}', name: 'delete.user')]
    public function deleteuserAction(ManagerRegistry $doctrine, $id)
    {
        $user = $doctrine->getRepository(Users::class)->findOneBy(['idusers' => $id]);
        $doctrine->getManager()->remove($user);
        $doctrine->getManager()->flush();

        return $this->redirect('/db/users/');
    }

    #[Route('/db/adduser/', name: 'add.user', methods: 'post')]
    public function insertuserAction(ManagerRegistry $doctrine, Request $request)
    {
        
        $user = new Users();
        $user->setFirstname($request->get('newFirstName'));
        $user->setLastname($request->get('newLastName'));
        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();

        return $this->redirect('/db/users/');
    }
}
