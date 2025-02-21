<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

final class TableController extends AbstractController
{
    #[Route('/', name: 'app_table')]
    public function index(UserRepository $UserRepository): Response
    {
        $users = $UserRepository->findAll();

        return $this->render('table/index.html.twig', [
            'users' => $users,
        ]);
    }

}
