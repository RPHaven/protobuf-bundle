<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\Exception;

use InvalidArgumentException;
use RpHaven\Uid\Uid;

final class UnhandledUidType extends InvalidArgumentException implements UidFactoryException
{
    public function __construct(public readonly Uid $uid)
    {
        parent::__construct(sprintf(
            'Unable to convert UID of type %s to gRPC: %s',
            get_class($this->uid),
            $this->uid->toString(),
        ));
    }
}