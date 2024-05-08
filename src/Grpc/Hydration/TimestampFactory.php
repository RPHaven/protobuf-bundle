<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Hydration;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Google\Protobuf\Timestamp;

final readonly class TimestampFactory
{
    public function toTimestamp(DateTimeInterface $dateTime): Timestamp
    {
        $timestamp = new Timestamp();
        $timestamp->fromDateTime(DateTime::createFromInterface($dateTime));

        return $timestamp;
    }

    public function fromTimestamp(Timestamp $timestamp): DateTimeImmutable
    {
        return DateTimeImmutable::createFromInterface($timestamp->toDateTime());
    }
}