<?php

declare(strict_types=1);

namespace Rphaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\Traits;

use Rphaven\Protobuf\Grpc\Factory\Uid\Exception\UnhandledGrpcType;
use Rphaven\Common\V1\Uid as GrpcUid;
use RpHaven\Uid\UidFactory;
use RpHaven\Uid\Uid;
use Symfony\Component\Uid\AbstractUid;

trait ToUid
{
    public function fromGrpc(GrpcUid $uid, UidFactory $factory): Uid
    {
        if (!$this->supportsGrpcUid($uid)) {
            throw new UnhandledGrpcType($uid);
        }

        return $factory->binary($this->toAbstractUid($uid)->toBinary());
    }

    abstract public function supportsGrpcUid(GrpcUid $uid): bool;

    abstract private function toAbstractUid(GrpcUid $uid): AbstractUid;
}