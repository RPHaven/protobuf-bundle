<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\Hydration;

use Google\Protobuf\Internal\Message;
use RpHaven\App\Message\Correlation;
use RpHaven\App\Uid\Id\Ulid\CorrelationUlid;
use RpHaven\Protobuf\Grpc\Hydration\Uid\SymfonyUid\UlidFactoryGrpc;
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

    public function fromGrpcMessage(Message $message): ?Correlation
    {
        if (method_exists($message, 'getCorrelation')) {
            $correlation = $message->getCorrelation();
            return new Correlation(
                $this->timestampFactory->fromTimestamp($correlation->getTimestamp()),
                CorrelationUlid::fromString($this->ulidFactory->fromGrpc($correlation->getId())->toRfc4122()),
            );
        }
    }
}