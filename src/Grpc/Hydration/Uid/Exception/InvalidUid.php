<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Hydration\Uid\Exception;

use InvalidArgumentException;
use Rphaven\Common\V1\Uid;
use Throwable;

final class InvalidUid extends InvalidArgumentException implements UidFactoryException
{
    public function __construct(public readonly Uid $uid, Throwable $previous)
    {
        parent::__construct(
            message: sprintf('Unable to create Uid. Type: %d', $this->uid->getType()),
            previous: $previous
        );
    }
}