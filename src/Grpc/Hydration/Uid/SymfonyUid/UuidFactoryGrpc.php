<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid;

use RpHaven\Protobuf\Grpc\Factory\Uid\GrpcUidFactory;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\SupportsGrpcUidType;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\SupportsUidType;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\ToUid;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\ToGrpcUid;
use Rphaven\Common\V1\Uid;
use Rphaven\Common\V1\UidType;
use RpHaven\Uid\Uid\Type;
use RpHaven\App\Uid\Id\Uuid\Type\Uuid as UuidType;
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