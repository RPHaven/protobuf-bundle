<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\CommandFactory\Exception;

use Google\Protobuf\Internal\Message as GrpcMessage;
use RpHaven\App\Message;
use RuntimeException;

final class UnableToCreateCorrelation extends RuntimeException implements CommandFactoryException
{
    public function __construct(
        public readonly Message      $appMessage,
        public readonly GrpcMessage $grpcMessage
    ) {
        parent::__construct(sprintf(
            'Unable to correlate message of type %s from grpc request %s',
            get_class($this->appMessage),
            get_class($this->grpcMessage),
        ));
    }
}