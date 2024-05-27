<?php

namespace App\Controller;

use App\Service\LogParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AnalyticsController extends AbstractController
{
    private $logParser;

    public function __construct(LogParser $logParser)
    {
        $this->logParser = $logParser;
    }

    #[Route('/count', name: 'count_logs', methods: ['GET'])]
    public function countLogs(Request $request): JsonResponse
    {
        $serviceNames = $request->query->get('serviceNames', []);
        $startDate = $request->query->get('startDate');
        $endDate = $request->query->get('endDate');
        $statusCode = $request->query->get('statusCode');

        $filters = [
            'serviceNames' => $serviceNames,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'statusCode' => $statusCode,
        ];

        $logs = file(__DIR__ . '/../../logs/logs.log', FILE_IGNORE_NEW_LINES);
        $counter = $this->logParser->parseLogs($logs, $filters);

        return new JsonResponse(['counter' => $counter]);
    }
}

