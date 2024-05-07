<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits;

use Rphaven\Common\Utils\Factory\Uid\Exception\UnhandledUidType;
use Rphaven\Common\V1\Uid as GrpcUid;
use RpHaven\Uid\Uid;
use RpHaven\Uid\Uid\Type;
use Symfony\Component\Uid\AbstractUid;

trait ToGrpcUid
{
    public function toGrpc(Uid $uid): GrpcUid
    {
        if (!$this->supportsUidType($uid->type())) {
            throw new UnhandledUidType($uid);
        }

        return new GrpcUid([
            'binary' => $uid->toBinary(),
            'type' => $this->uidType(),
        ]);
    }

    abstract private function supportsUidType(Type $uidType): bool;

    abstract private function uidType(): int;
}