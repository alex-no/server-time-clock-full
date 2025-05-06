<?php

namespace ServerTimeClock\Client;

use RuntimeException;

abstract class BaseTimeApiClient
{
    const TIMEOUT = 5;
    
    protected function executeCurl(array $curlOpt): string
    {
        $curl = curl_init();
        curl_setopt_array($curl, $curlOpt);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        if ($response === false || $httpCode >= 400) {
            throw new RuntimeException("Failed to fetch time data: {$error} (HTTP {$httpCode})");
        }

        return $response;
    }

    protected function fetchAndDecode(array $curlOpt): array
    {
        $response = $this->executeCurl($curlOpt);

        $data = json_decode($response, true);
        if (!is_array($data)) {
            throw new RuntimeException("Invalid JSON received from time API");
        }

        return $data;
    }
}
