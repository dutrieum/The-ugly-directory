<?php

namespace App\Controller;

use App\Entity\Villager;
use App\Form\VillagerType;
use App\Repository\VillagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;

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

    #[IsGranted('ROLE_USER')]
    #[Route('/new', name: 'app_villager_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VillagerRepository $villagerRepository, SluggerInterface $slugger): Response
    {
        $villager = new Villager();
        $form = $this->createForm(VillagerType::class, $villager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image_url')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $villager->setImageUrl($newFilename);
            }

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

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_villager_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Villager $villager, VillagerRepository $villagerRepository, SluggerInterface $slugger): Response
    {
        $imageFileName = $villager->getImageUrl();
        $villager->setImageUrl(
            new File($this->getParameter('images_directory').'/'.$villager->getImageUrl())
        );

        $form = $this->createForm(VillagerType::class, $villager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image_url')->getData();

            if ($imageFile !== null) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move (
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $villager->setImageUrl($newFilename);
            } else {
                $villager->setImageUrl($imageFileName);
            }

            $villagerRepository->save($villager, true);

            return $this->redirectToRoute('app_villager_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('villager/edit.html.twig', [
            'villager' => $villager,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_villager_delete', methods: ['POST'])]
    public function delete(Request $request, Villager $villager, VillagerRepository $villagerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$villager->getId(), $request->request->get('_token'))) {
            $villagerRepository->remove($villager, true);
        }

        return $this->redirectToRoute('app_villager_index', [], Response::HTTP_SEE_OTHER);
    }
}
