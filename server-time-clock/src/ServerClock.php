<?php

namespace ServerTimeClock;

use Psr\Clock\ClockInterface;
use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

/**
 * PSR-20 compatible clock that returns the current server time in its local timezone.
 */
class ServerClock implements ClockInterface
{
    private DateTimeZone $timezone;

    /**
     * @throws RuntimeException if timezone is not supported or available
     */
    public function __construct(?string $timezone = null)
    {
        try {
            $this->timezone = new DateTimeZone($timezone ?? date_default_timezone_get());
        } catch (\Exception $e) {
            throw new RuntimeException('Invalid or unavailable timezone: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Returns the current server time as DateTimeImmutable.
     *
     * @return DateTimeImmutable
     */
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', $this->timezone);
    }

    /**
     * Returns the timezone used by the clock.
     *
     * @return DateTimeZone
     */
    public function getTimezone(): DateTimeZone
    {
        return $this->timezone;
    }
}
