<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CallApiService;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('home/home.html.twig', [
            'balise' => $callApiService->getAllData()
        ]);
    }
}
