<?php

namespace App\Controller;

use App\Form\TVFormType;
use App\Entity\TV;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;


class TvController extends AbstractController
{
    #[Route('/tv', name: 'tv')]
    public function index(ManagerRegistry $doctrine)
    {

        $tv = $doctrine->getRepository(TV::class)->findAll();
        return $this->render('tv/index.html.twig', [
            'tv' => $tv,
        ]);
    }
    #[Route('/tv/add', name: 'tv.add')]
    public function createTv(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tv = new TV();

        $form = $this->createForm(TVFormType::class, $tv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($tv);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('tv');
        }

            return $this->render('tv/add.html.twig', [
                'formAddTV'=>$form->createView()
            ]);
    }
    #[Route('/tv/remove/{id}', name: 'tv.remove')]
    public function removeTV(ManagerRegistry $doctrine, $id)
    {
        $tv = $doctrine->getRepository(TV::class)->findOneBy(['id' => $id]);
        $doctrine->getManager()->remove($tv);
        $doctrine->getManager()->flush();

        return $this->redirect('tv/index.html.twig');
       
    }
}
