<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc;

use Google\Protobuf\Internal\Message;
use Spiral\RoadRunner\GRPC\ContextInterface;
use RpHaven\App\Message\Command;

interface CommandFactory
{
    public function build(
        ContextInterface $context,
        Message $message,
    ): Command;
}