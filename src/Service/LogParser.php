<?php

namespace App\Service;

class LogParser
{
    public function parseLogs(array $logs, array $filters): int
    {
        $counter = 0;

        foreach ($logs as $log) {
            if ($this->matchesFilters($log, $filters)) {
                $counter++;
            }
        }

        return $counter;
    }

    private function matchesFilters(string $log, array $filters): bool
    {
        // Перевірка сервісних імен
        if (!empty($filters['serviceNames'])) {
            $serviceMatch = false;
            foreach ($filters['serviceNames'] as $serviceName) {
                if (strpos($log, $serviceName) !== false) {
                    $serviceMatch = true;
                    break;
                }
            }
            if (!$serviceMatch) {
                return false;
            }
        }

        // Перевірка дати
        if (!empty($filters['startDate']) || !empty($filters['endDate'])) {
            preg_match('/\[(.*?)\]/', $log, $matches);
            $logDate = \DateTime::createFromFormat('d/M/Y:H:i:s O', $matches[1]);

            if (!empty($filters['startDate'])) {
                $startDate = new \DateTime($filters['startDate']);
                if ($logDate < $startDate) {
                    return false;
                }
            }

            if (!empty($filters['endDate'])) {
                $endDate = new \DateTime($filters['endDate']);
                if ($logDate > $endDate) {
                    return false;
                }
            }
        }

        // Перевірка статусу
        if (!empty($filters['statusCode'])) {
            if (preg_match('/" (\d{3})$/', $log, $statusMatches)) {
                $logStatusCode = (int) $statusMatches[1];
                if ($logStatusCode !== (int) $filters['statusCode']) {
                    return false;
                }
            } else {
                return false;
            }
        }

        return true;
    }
}
