<?php

namespace ServerTimeClock\Tests;

use PHPUnit\Framework\TestCase;
use ServerTimeClock\ServerClock;
use DateTimeZone;

class ServerClockTest extends TestCase
{
    public function testNowReturnsDateTimeImmutable()
    {
        $clock = new ServerClock();
        $now = $clock->now();

        $this->assertInstanceOf(\DateTimeImmutable::class, $now);
    }

    public function testTimezoneCanBeSpecified()
    {
        $clock = new ServerClock('Europe/Kyiv');
        $now = $clock->now();

        $this->assertSame('Europe/Kyiv', $now->getTimezone()->getName());
    }

    public function testInvalidTimezoneThrowsException()
    {
        $this->expectException(\RuntimeException::class);
        new ServerClock('Invalid/Timezone');
    }
}
