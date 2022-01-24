<?php

namespace App\Controller;

use App\Models\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigsController extends AbstractController
{
    #[Route('/twigs', name: 'twigs')]
    public function index(): Response
    {
        return $this->render('twigs/index.html.twig', [
            'message' => 'Hello world from twig',
            'people' => Person::CreateTestList(),
            'flag' => 1
        ]);
    }

    #[Route('/twigs/detail', name: 'twigsdetail')]
    public function detail(): Response
    {
        return $this->render('twigs/detail.html.twig', [
            'message' => 'Detail twig'
        ]);
    }
}
