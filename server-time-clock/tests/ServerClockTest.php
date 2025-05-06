<?php

namespace ServerTimeClock\Tests;

use PHPUnit\Framework\TestCase;
use ServerTimeClock\ServerClock;
use DateTimeZone;

class ServerClockTest extends TestCase
{
    public $config = [
        'client' => 'WorldTimeApi', // preferred
        'credentials' => [
            'IpGeoLocation' => '71fba5dbb71e4e87a94cea31783d9f2a',  // Example key for IpGeolocation
            // 'WorldTimeApi' => 'TOKEN',                           // Example key for WorldTimeAPI
        ],
    ];

    public function testNowReturnsDateTimeImmutable()
    {
        $clock = new ServerClock($this->config);
        $now = $clock->now();

        $this->assertInstanceOf(\DateTimeImmutable::class, $now);
    }

    public function testTimezoneCanBeSpecified()
    {
        $clock = new ServerClock($this->config);
        $now = $clock->now();

        $this->assertSame('timezone', $now->getTimezone()->getName());
    }

    // public function testInvalidTimezoneThrowsException()
    // {
    //     $this->expectException(\RuntimeException::class);
    //     new ServerClock('Invalid/Timezone');
    // }
}
