<?php

namespace ServerTimeClock;

use ServerTimeClock\Client\TimeApiClient;
use DateTimeImmutable;
use DateTimeZone;
use RuntimeException;

class ServerClock
{
    private TimeApiClient $client;
    private array $data;

    public function __construct(array $config)
    {
        // Get the client and data through ClientManager
        $manager = new ClientManager($config);
        $this->data = $manager->getAvailableClientData(); // Fetch data immediately
    }

    /**
     * Returns the current server time as DateTimeImmutable.
     *
     * @return DateTimeImmutable
     */
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable($this->getFormattedTime(), $this->getTimezone());
    }

    /**
     * Returns the timezone used by the clock.
     *
     * @return DateTimeZone
     */
    public function getTimezone(): DateTimeZone
    {
        try {
            $timezone = new DateTimeZone($this->getData()['timezone'] ?? 'Unknown');
        } catch (\Exception $e) {
            throw new RuntimeException('Invalid or unavailable timezone: ' . $e->getMessage(), 0, $e);
        }
        return $timezone;
    }
    /**
     * Returns the client name used to fetch the time data.
     *
     * @return string
     */
    public function getClientName(): string
    {
        return $this->getData()['client_name'] ?? 'Unknown';
    }

    /**
     * Returns the data retrieved from the client
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
    /**
     * Returns time data in a convenient format
     *
     * @return string
     */
    public function getFormattedTime(): string
    {
        $data = $this->getData();
        return sprintf(
            '%d-%02d-%02d %02d:%02d:%02d.%03d',
            $data['year'],
            $data['month'],
            $data['day'],
            $data['hour'],
            $data['minute'],
            $data['seconds'],
            $data['milli_seconds']
        );
    }
}
