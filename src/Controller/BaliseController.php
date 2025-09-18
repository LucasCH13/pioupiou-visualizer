<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\ExpressionLanguage\Expression;

use App\Service\CallApiService;


final class BaliseController extends AbstractController
{
    #[Route('/balise/{id}', name: 'app_balise')]
    public function index(int $id, CallApiService $callApiService, ChartBuilderInterface $chartBuilder): Response
    {
        $windDegrees = $callApiService->getDataLiveById($id);
        $windDirIndex = round($windDegrees['data']['measurements']['wind_heading'] / 22.5) % 16; //convertis une direction de vent (0 à 360°) en un index de 0 à 16 par tranche de 22.5°
        $graph = $callApiService->getDataArchivedById($id);
        $direction=[];
        $vitesse=[];

        foreach($graph['data'] as $data) {
            $date[] = $data[0];
            $direction[] = $data[4];
            $vitesse[] = $data[6];
        }
    
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $vitesse,
            'datasets' => [
                [
                    'label' => 'Vent moyen sur une journée entière en km/h',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $direction,
                ],
            ],
        ]);

        $chart->setOptions([
          
            'maintainAspectRatio' => false, 
        
        ]);
        return $this->render('balise/index.html.twig', [
            'balise' => $callApiService->getDataLiveById($id),
            'balise_archive' => $callApiService->getDataArchivedById($id),
            'windDirIndex' => $windDirIndex,
            'chart' => $chart,

        ]);
    }

}
