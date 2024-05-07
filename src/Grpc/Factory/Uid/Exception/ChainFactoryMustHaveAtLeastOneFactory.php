<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\Exception;

use InvalidArgumentException;

final class ChainFactoryMustHaveAtLeastOneFactory extends InvalidArgumentException implements UidFactoryException
{
    public function __construct()
    {
        parent::__construct('Chain factory must have at least one factory');
    }
}