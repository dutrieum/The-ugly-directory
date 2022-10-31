<?php

namespace App\Controller;

use App\Entity\Villager;
use App\Form\VillagerType;
use App\Repository\VillagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/villager')]
class VillagerController extends AbstractController
{
    #[Route('/', name: 'app_villager_index', methods: ['GET'])]
    public function index(VillagerRepository $villagerRepository): Response
    {
        return $this->render('villager/index.html.twig', [
            'villagers' => $villagerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_villager_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VillagerRepository $villagerRepository): Response
    {
        $villager = new Villager();
        $form = $this->createForm(VillagerType::class, $villager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $villagerRepository->save($villager, true);

            return $this->redirectToRoute('app_villager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villager/new.html.twig', [
            'villager' => $villager,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_villager_show', methods: ['GET'])]
    public function show(Villager $villager): Response
    {
        return $this->render('villager/show.html.twig', [
            'villager' => $villager,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_villager_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Villager $villager, VillagerRepository $villagerRepository): Response
    {
        $form = $this->createForm(VillagerType::class, $villager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $villagerRepository->save($villager, true);

            return $this->redirectToRoute('app_villager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villager/edit.html.twig', [
            'villager' => $villager,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_villager_delete', methods: ['POST'])]
    public function delete(Request $request, Villager $villager, VillagerRepository $villagerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$villager->getId(), $request->request->get('_token'))) {
            $villagerRepository->remove($villager, true);
        }

        return $this->redirectToRoute('app_villager_index', [], Response::HTTP_SEE_OTHER);
    }
}
