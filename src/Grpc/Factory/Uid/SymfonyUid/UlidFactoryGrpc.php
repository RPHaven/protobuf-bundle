<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid\SymfonyUid;

use Rphaven\Common\Utils\Factory\Uid\GrpcUidFactory;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\SupportsGrpcUidType;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\SupportsUidType;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\ToGrpcUid;
use Rphaven\Common\Utils\Factory\Uid\SymfonyUid\Traits\ToUid;
use Rphaven\Common\V1\Uid as GrpcUid;
use Rphaven\Common\V1\UidType;
use RpHaven\Uid\Uid\Type;
use RpHaven\Uid\Uuid\Type\Ulid as UlidType;
use Symfony\Component\Uid\Ulid;

final readonly class UlidFactoryGrpc implements GrpcUidFactory
{
    use ToGrpcUid;
    use SupportsGrpcUidType;
    use SupportsUidType;
    use ToUid;

    private function uidType(): int
    {
        return UidType::UID_TYPE_ULID;
    }

    private function toAbstractUid(GrpcUid $uid): Ulid
    {
        return match (true) {
            $uid->hasBinary() => Ulid::fromBinary($uid->getBinary()),
            $uid->hasRfc4122() => Ulid::fromRfc4122($uid->getRfc4122()),
        };
    }


    public function supportsUidType(Type $uidType): bool
    {
        return $uidType->name() === UlidType::DEFAULT->name();
    }
}