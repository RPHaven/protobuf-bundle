<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory;

use DateTimeImmutable;
use DateTimeInterface;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\UlidFactoryGrpc;
use Rphaven\Common\Utils\Uid\ErrorId;
use Rphaven\Common\V1\Error;

use Stringable;

final readonly class ErrorFactory
{
    public function __construct(
        private UlidFactoryGrpc  $ulidFactory,
        private TimestampFactory $timestampFactory,
    ) {

    }

    public function toGrpcError(
        string|Stringable $reason,
        ?ErrorId $errorId = null,
        ?DateTimeInterface $dateTime = new DateTimeImmutable(),
    ): Error {
        $errorId = $errorId ?? ErrorId::init($dateTime);

        return new Error([
            'id' => $this->ulidFactory->toUid($errorId->ulid),
            'timestamp' => $this->timestampFactory->toTimestamp($errorId->ulid->getDateTime()),
            'reason' => (string) $reason,
        ]);
    }
}