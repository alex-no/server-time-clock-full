<?php

require_once __DIR__ . '/vendor/autoload.php';

use ServerTimeClock\ServerClock;
use Psr\Clock\ClockInterface;

function describeClock(ClockInterface $clock): void {
    $now = $clock->now();

    echo "== Clock Info ==" . PHP_EOL;
    echo "Class: " . get_class($clock) . PHP_EOL;
    echo "Implements: " . implode(', ', class_implements($clock)) . PHP_EOL;
    echo "Now: " . $now->format(DATE_ATOM) . PHP_EOL;
    echo "Timezone: " . $now->getTimezone()->getName() . PHP_EOL;
    echo PHP_EOL;
}

$clock = new ServerClock(); // default server timezone
describeClock($clock);

$kyivClock = new ServerClock('Europe/Kyiv');
describeClock($kyivClock);
