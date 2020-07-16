<?php

namespace App\Controller;

use App\Entity\AnalysisCategories;
use App\Form\AnalysisCategoriesType;
use App\Repository\AnalysisCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/analysis/categories")
 */
class AnalysisCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="analysis_categories_index", methods={"GET"})
     */
    public function index(AnalysisCategoriesRepository $analysisCategoriesRepository): Response
    {
        return $this->render('analysis_categories/index.html.twig', [
            'analysis_categories' => $analysisCategoriesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="analysis_categories_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $analysisCategory = new AnalysisCategories();
        $form = $this->createForm(AnalysisCategoriesType::class, $analysisCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($analysisCategory);
            $entityManager->flush();

            return $this->redirectToRoute('analysis_categories_index');
        }

        return $this->render('analysis_categories/new.html.twig', [
            'analysis_category' => $analysisCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="analysis_categories_show", methods={"GET"})
     */
    public function show(AnalysisCategories $analysisCategory): Response
    {
        return $this->render('analysis_categories/show.html.twig', [
            'analysis_category' => $analysisCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="analysis_categories_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AnalysisCategories $analysisCategory): Response
    {
        $form = $this->createForm(AnalysisCategoriesType::class, $analysisCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analysis_categories_index');
        }

        return $this->render('analysis_categories/edit.html.twig', [
            'analysis_category' => $analysisCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="analysis_categories_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AnalysisCategories $analysisCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$analysisCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($analysisCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('analysis_categories_index');
    }
}
