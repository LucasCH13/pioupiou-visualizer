<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CallApiService;

final class BaliseController extends AbstractController
{
    #[Route('/balise/{id}', name: 'app_balise')]
    public function index(int $id, CallApiService $callApiService): Response
    {
        return $this->render('balise/index.html.twig', [
            'balise' => $callApiService->getDataLiveById($id),
        ]);
    }
}
