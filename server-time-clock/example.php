<?php

use ServerTimeClock\ServerClock;

require 'vendor/autoload.php';

$config = [
    'client' => 'WorldTimeApi', // preferred
    'credentials' => [
        'IpGeoLocation' => '71fba5dbb71e4e87a94cea31783d9f2a',  // Example key for IpGeolocation
        // 'WorldTimeApi' => 'TOKEN',                           // Example key for WorldTimeAPI
    ],
    'enable_cache' => true,
    'cache_ttl' => 300, // 5 minutes
];

try {
    $clock = new ServerClock($config);
    echo "Current date/time: " . $clock->now()->format('Y-m-d H:i:s') . PHP_EOL;
    echo "Timezone: " . $clock->getTimezone()->getName() . PHP_EOL;
    echo "Used client: " . $clock->getClientName() . PHP_EOL;
} catch (\UnexpectedValueException $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

