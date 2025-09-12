<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Service\CallApiService;

final class BaliseController extends AbstractController
{
    #[Route('/balise/{id}', name: 'app_balise')]
    public function index(int $id, CallApiService $callApiService, ChartBuilderInterface $chartBuilder): Response
    {
        $windDegrees = $callApiService->getDataLiveById($id);
        $windDirIndex = round($windDegrees['data']['measurements']['wind_heading'] / 22.5) % 16; //convertis une direction de vent (0 à 360°) en un index de 0 à 16 par tranche de 22.5°
        return $this->render('balise/index.html.twig', [
            'balise' => $callApiService->getDataLiveById($id),
            'balise_archive' => $callApiService->getDataArchivedById($id),
            'windDirIndex' => $windDirIndex,
        ]);
    }

}
