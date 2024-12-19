<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use App\Repository\NiveauRepository;
use App\Repository\ProfesseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'cours.index', methods:['GET'])]
    public function index(CoursRepository $coursRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 5;
        $count = 0;
        $totalPages = 0;

        // Pagination pour afficher les cours
        $cours = $coursRepository->findBy([], [], $limit, ($page - 1) * $limit);
        $count = count($cours);
        $totalPages = ceil($count / $limit);

        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
            'page' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    #[Route('/cours/store', name: 'cours.store', methods:['GET','POST'])]
    public function store(Request $request, EntityManagerInterface $entityManager, ProfesseurRepository $professeurRepository, NiveauRepository $niveauRepository): Response
    {
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération du professeur et du niveau
            $professeur = $form->get('professeur')->getData();
            $niveau = $form->get('niveau')->getData();

            $cours->setProfesseur($professeur);
            $cours->setNiveau($niveau);

            $entityManager->persist($cours);
            $entityManager->flush();

            return $this->redirectToRoute('cours.index');
        }

        return $this->render('cours/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/cours/show/{id}', name: 'cours.show', methods:['GET'])]
    public function show(CoursRepository $coursRepository, int $id): Response
    {
        $cours = $coursRepository->findOneBy(['id' => $id]);

        if (!$cours) {
            throw $this->createNotFoundException('Cours non trouvé');
        }

        return $this->render('cours/show.html.twig', [
            'cours' => $cours,
        ]);
    }

    #[Route('/cours/filter/niveau/{niveauId}', name: 'cours.filter.niveau', methods:['GET'])]
    public function filterByNiveaux(CoursRepository $coursRepository, NiveauRepository $niveauRepository, int $niveauId): Response
    {
        $niveau = $niveauRepository->find($niveauId);

        if (!$niveau) {
            throw $this->createNotFoundException('Niveau non trouvé');
        }

        // Filtrer les cours par niveau
        $cours = $coursRepository->findBy(['niveau' => $niveau]);

        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
        ]);
    }

    #[Route('/cours/filter/professeur/{professeurId}', name: 'cours.filter.professeur', methods:['GET'])]
    public function filterByProfesseur(CoursRepository $coursRepository, ProfesseurRepository $professeurRepository, int $professeurId): Response
    {
        $professeur = $professeurRepository->find($professeurId);

        if (!$professeur) {
            throw $this->createNotFoundException('Professeur non trouvé');
        }

        // Filtrer les cours par professeur
        $cours = $coursRepository->findBy(['professeur' => $professeur]);

        return $this->render('cours/index.html.twig', [
            'cours' => $cours,
        ]);
    }
}
