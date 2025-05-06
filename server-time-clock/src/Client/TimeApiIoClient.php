<?php

namespace ServerTimeClock\Client;

use RuntimeException;

class TimeApiIoClient extends BaseTimeApiClient implements TimeApiClient
{
    /**
     * The API endpoint for the TimeAPI service.
     * This endpoint is used to fetch the current time and timezone information based on the client's IP address.
     */
    const ENDPOINT = 'https://timeapi.io/api/Time/current/ip';
    /**
     * The API endpoint for the IP Geolocation service.
     * This endpoint is used to fetch the public IP address of the client.
     */
    const ENDPOINT_URL = 'https://api.ipify.org';

    public function __construct($apiKey = null)
    {
    }

    /**
     * Fetches the current time and timezone information from the TimeAPI service.
     *
     * @return array The normalized data containing timezone and time information.
     * @throws RuntimeException if the API request fails or returns invalid data.
     */
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

    /**
     * Normalize the data structure to match your application's needs
     */
    protected function normalizeData(array $sourceData): array
    {
        return [
            'client_name' => 'TimeApiIo',
            'timezone' => $sourceData['timeZone'] ?? null,
            'year' => $sourceData['year'] ?? null,
            'month' => $sourceData['month'] ?? null,
            'day' => $sourceData['day'] ?? null,
            'hour' => $sourceData['hour'] ?? null,
            'minute' => $sourceData['minute'] ?? null,
            'seconds' => $sourceData['seconds'] ?? null,
            'milli_seconds' => $sourceData['milliSeconds'] ?? null,
        ];
    }
}
