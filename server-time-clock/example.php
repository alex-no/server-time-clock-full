<?php

require_once __DIR__ . '/vendor/autoload.php';

use ServerTimeClock\ServerClock;

$clock = new ServerClock(); // Использует временную зону сервера
$now = $clock->now();

echo "Current server time: " . $now->format(DATE_ATOM) . PHP_EOL;
echo "Timezone: " . $clock->getTimezone()->getName() . PHP_EOL;
echo "Timezone offset: " . $now->getOffset() . " seconds" . PHP_EOL;
