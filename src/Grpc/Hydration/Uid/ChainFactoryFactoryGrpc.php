<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Hydration\Uid;

use RpHaven\Protobuf\Grpc\Hydration\Uid\Exception\ChainFactoryMustHaveAtLeastOneFactory;
use RpHaven\Protobuf\Grpc\Hydration\Uid\SymfonyUid\UlidFactoryGrpc;
use RpHaven\Protobuf\Grpc\Hydration\Uid\SymfonyUid\UuidFactoryGrpc;
use Rphaven\Common\V1\Uid as GrpcUid;
use RpHaven\Uid\UidFactory;
use RpHaven\Uid\Uid;

final readonly class ChainFactoryFactoryGrpc implements GrpcUidFactory
{

    private array $symfonyUidFactories;

    public static function init(): self
    {
        return new self(
            new UuidFactoryGrpc(),
            new UlidFactoryGrpc(),
        );
    }

    public function __construct(GrpcUidFactory ...$symfonyUidFactories)
    {
        if (empty($symfonyUidFactories)) {
            throw new ChainFactoryMustHaveAtLeastOneFactory();
        }
        $this->symfonyUidFactories = $symfonyUidFactories;
    }

    #[\Override] public function fromGrpc(GrpcUid $uid, UidFactory $uidFactory): Uid
    {
        foreach ($this->symfonyUidFactories as $factory) {
            if ($factory->supportsGrpcUid($uid)) {
                return $factory->fromGrpc($uid, $uidFactory);
            }
        }
    }

    public function supportsUid(Uid $uid): bool
    {
        foreach ($this->symfonyUidFactories as $factory) {
            if ($factory->supportsUid($uid)) {
                return true;
            }
        }

        return false;
    }

    #[\Override] public function toGrpc(Uid $uid): GrpcUid
    {
        foreach ($this->symfonyUidFactories as $factory) {
            if ($factory->supportsUid($uid)) {
                return $factory->toGrpc($uid);
            }
        }
    }

    #[\Override] public function supportsGrpcUid(GrpcUid $uid): bool
    {
        foreach ($this->symfonyUidFactories as $factory) {
            if ($factory->supportsGrpcUid($uid)) {
                return true;
            }
        }

        return false;
    }
}