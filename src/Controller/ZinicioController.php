<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ZinicioController extends AbstractController
{
    /**
     * @Route("/zinicio", name="app_zinicio")
     */
    public function index(): Response
    {
        return $this->render('zinicio/index.html.twig', [
            'controller_name' => 'ZinicioController',
        ]);
    }
}
