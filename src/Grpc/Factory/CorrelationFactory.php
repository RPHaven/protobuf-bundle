<?php

declare(strict_types=1);

namespace Rphaven\Protobuf\Grpc\Factory;

use RpHaven\App\Correlation;
use RpHaven\App\Uid\Ulid\Id\CorrelationUlid;
use Rphaven\Protobuf\Grpc\Factory\Uid\SymfonyUid\UlidFactoryGrpc;
use Rphaven\Common\V1\Correlation as GrpcCorrelation;


final readonly class CorrelationFactory
{
    public function __construct(private UlidFactoryGrpc $ulidFactory, private TimestampFactory $timestampFactory)
    {

    }
    public function toGrpcCorrelation(
        Correlation $correlation
    ): GrpcCorrelation {
        return new GrpcCorrelation([
            'id' => $this->ulidFactory->toGrpc($correlation->correlationId),
            'timestamp' => $this->timestampFactory->toTimestamp($correlation->dateTime),
        ]);
    }

    public function fromGrpcCorrelation(GrpcCorrelation $correlation): Correlation
    {
        return new Correlation(
            $this->timestampFactory->fromTimestamp($correlation->getTimestamp()),
            CorrelationUlid::fromString($this->ulidFactory->fromGrpc($correlation->getId())->toRfc4122()),
        );
    }
}