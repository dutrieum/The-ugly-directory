<?php

namespace App\Controller;

use App\Repository\VillagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(VillagerRepository $villagerRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'villagers' => $villagerRepository->findAll(),
            'controller_name' => 'HomeController',
        ]);
    }
}
