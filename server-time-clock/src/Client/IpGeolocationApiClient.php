<?php

namespace ServerTimeClock\Client;

class IpGeolocationApiClient extends BaseTimeApiClient implements TimeApiClient
{
    const ENDPOINT = 'https://api.ipgeolocation.io/timezone?apiKey=';

    private ?string $apiKey;


    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function fetch(): array
    {
        $url = self::ENDPOINT . urlencode($this->apiKey);

        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => self::TIMEOUT,
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
