<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\Exception;

use InvalidArgumentException;
use Rphaven\Common\V1\Uid;

final class UnhandledGrpcType extends InvalidArgumentException implements UidFactoryException
{
    public function __construct(public readonly Uid $uid)
    {
        parent::__construct(sprintf(
            'Unable to convert UID of type %d', $this->uid->getType(),
        ));
    }
}