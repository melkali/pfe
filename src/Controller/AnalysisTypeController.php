<?php

namespace App\Controller;

use App\Entity\AnalysisType;
use App\Form\AnalysisTypeType;
use App\Repository\AnalysisTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/analysis/type")
 */
class AnalysisTypeController extends AbstractController
{
    /**
     * @Route("/", name="analysis_type_index", methods={"GET"})
     */
    public function index(AnalysisTypeRepository $analysisTypeRepository): Response
    {
        return $this->render('analysis_type/index.html.twig', [
            'analysis_types' => $analysisTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="analysis_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $analysisType = new AnalysisType();
        $form = $this->createForm(AnalysisTypeType::class, $analysisType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($analysisType);
            $entityManager->flush();

            return $this->redirectToRoute('analysis_type_index');
        }

        return $this->render('analysis_type/new.html.twig', [
            'analysis_type' => $analysisType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="analysis_type_show", methods={"GET"})
     */
    public function show(AnalysisType $analysisType): Response
    {
        return $this->render('analysis_type/show.html.twig', [
            'analysis_type' => $analysisType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="analysis_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AnalysisType $analysisType): Response
    {
        $form = $this->createForm(AnalysisTypeType::class, $analysisType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('analysis_type_index');
        }

        return $this->render('analysis_type/edit.html.twig', [
            'analysis_type' => $analysisType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="analysis_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, AnalysisType $analysisType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$analysisType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($analysisType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('analysis_type_index');
    }
}
