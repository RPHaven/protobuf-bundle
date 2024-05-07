<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\SymfonyUid;

use Rphaven\Common\Utils\Factory\Uid\GrpcUidFactory;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\SupportsGrpcUidType;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\SupportsUidType;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\ToUid;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\ToGrpcUid;
use Rphaven\Common\V1\Uid;
use Rphaven\Common\V1\UidType;
use RpHaven\Uid\Uid\Type;
use RpHaven\Uid\Uuid\Type\Uuid as UuidType;
use Symfony\Component\Uid\AbstractUid;
use Symfony\Component\Uid\Uuid;

final readonly class UuidFactoryGrpc implements GrpcUidFactory
{
    use ToGrpcUid;
    use SupportsGrpcUidType;
    use SupportsUidType;
    use ToUid;

    private function toAbstractUid(Uid $uid): AbstractUid
    {
        return match (true) {
            $uid->hasBinary() => Uuid::fromBinary($uid->getBinary()),
            $uid->hasRfc4122() => Uuid::fromRfc4122($uid->getRfc4122()),
        };
    }

    private function uidType(): int
    {
       return UidType::UID_TYPE_UUID;
    }

    private function supportsUidType(Type $uidType): bool
    {
        return $uidType->name() === UuidType::NAME;
    }
}