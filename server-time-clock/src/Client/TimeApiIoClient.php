<?php

namespace ServerTimeClock\Client;

use RuntimeException;

class TimeApiIoClient extends BaseTimeApiClient implements TimeApiClient
{
    const ENDPOINT = 'https://timeapi.io/api/Time/current/ip';
    const ENDPOINT_URL = 'https://api.ipify.org';

    public function __construct($apiKey = null)
    {
    }

    public function fetch(): array
    {
        $ip = $this->getPublicIp();
        $url = self::ENDPOINT . '?ipAddress=' . urlencode($ip);

        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => self::TIMEOUT,
        ];

        $data = $this->fetchAndDecode($curlOptions);
        return $this->normalizeData($data);
    }

    private function getPublicIp(): string
    {
        $curlOptions = [
            CURLOPT_URL => self::ENDPOINT_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => self::TIMEOUT,
        ];

        $ip = $this->executeCurl($curlOptions);
        return trim($ip);
    }

    protected function normalizeData(array $sourceData): array
    {
        // Normalize the data structure to match your application's needs
        return $sourceData;
    }
}
