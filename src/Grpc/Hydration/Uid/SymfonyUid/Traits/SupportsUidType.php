<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Hydration\Uid\SymfonyUid\Traits;

use RpHaven\Uid\Uid;
use RpHaven\Uid\Uid\Type;

trait SupportsUidType
{
    public function supportsUid(Uid $uid): bool
    {
        return $this->supportsUidType($uid->type());
    }

    abstract private function supportsUidType(Type $type): bool;
}