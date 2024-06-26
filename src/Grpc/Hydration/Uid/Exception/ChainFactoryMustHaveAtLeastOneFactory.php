<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Hydration\Uid\Exception;

use InvalidArgumentException;

final class ChainFactoryMustHaveAtLeastOneFactory extends InvalidArgumentException implements UidFactoryException
{
    public function __construct()
    {
        parent::__construct('Chain factory must have at least one factory');
    }
}