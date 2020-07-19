<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PatientResultController extends AbstractController
{
    /**
     * @Route("/patient/result", name="patient_result")
     */
    public function index()
    {
        return $this->render('patient_result/index.html.twig', [
            'controller_name' => 'PatientResultController',
        ]);
    }
}
