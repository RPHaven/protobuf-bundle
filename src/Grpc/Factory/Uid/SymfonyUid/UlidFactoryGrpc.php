<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid;

use RpHaven\App\Uid\Id\Uuid\Type\Ulid as UlidType;
use RpHaven\Protobuf\Grpc\Factory\Uid\GrpcUidFactory;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\SupportsGrpcUidType;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\SupportsUidType;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\ToGrpcUid;
use RpHaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits\ToUid;
use Rphaven\Common\V1\Uid as GrpcUid;
use Rphaven\Common\V1\UidType;
use RpHaven\Uid\Uid\Type;
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