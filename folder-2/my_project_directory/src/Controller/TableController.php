<?php

namespace App\Controller;

use App\Repository\DetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;

final class TableController extends AbstractController
{
    #[Route('/table/{id}/detail', name: 'app_table_detail')]
    public function read(DetailRepository $detailRepository, int $id): Response
    {
        $details = $detailRepository->findBy(['id' => $id]);

        if (!$details) {
            return $this->redirectToRoute('app_crud');
        }

        return $this->render('table/detail.html.twig', [
            'details' => $details,
        ]);
    }

    #[Route('/', name: 'app_table')]
    public function index(UserRepository $UserRepository): Response
    {
        $users = $UserRepository->findAll();

        return $this->render('table/index.html.twig', [
            'users' => $users,
        ]);
    }

}
