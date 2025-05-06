<?php

namespace ServerTimeClock\Client;

class WorldTimeApiClient extends BaseTimeApiClient implements TimeApiClient
{
    const ENDPOINT = 'https://worldtimeapi.org/api/ip';

    private ?string $apiKey;

    public function __construct(?string $apiKey = null)
    {
        $this->apiKey = $apiKey;
    }

    public function fetch(): array
    {
        $headers = [];
        if ($this->apiKey !== null) {
            // This header scheme may vary depending on the service
            $headers[] = 'Authorization: Bearer ' . $this->apiKey;
        }

        $curlOptions = [
            CURLOPT_URL => self::ENDPOINT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => self::TIMEOUT,
            CURLOPT_HTTPHEADER => $headers,
        ];

        $data = $this->fetchAndDecode($curlOptions);
        return $this->normalizeData($data);
    }

    protected function normalizeData(array $sourceData): array
    {
        // Normalize the data structure to match your application's needs
        return $sourceData;
    }
}
