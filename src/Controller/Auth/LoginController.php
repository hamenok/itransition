<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/{_locale<%app.supported_locales%>}/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        // получить ошибку входа, если она есть
         $error = $authenticationUtils->getLastAuthenticationError();
         // последнее имя пользователя, введенное пользователем
         $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
    #[Route('/{_locale<%app.supported_locales%>}/logout', name: 'app_logout', methods: ['GET'])]
    public function logout()
    {
        // контроллер может быть пустым: он не будет вызван!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
