<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits;

use Rphaven\Common\V1\Uid;

trait SupportsGrpcUidType
{
    public function supportsGrpcUid(Uid $uid): bool
    {
        return $uid->getType() === $this->uidType();
    }

    abstract private function uidType(): int;

}