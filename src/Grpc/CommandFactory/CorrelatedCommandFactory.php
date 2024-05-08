<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\CommandFactory;

use Google\Protobuf\Internal\Message;
use RpHaven\App\Message\Command;
use RpHaven\App\Message\Correlated;
use RpHaven\Protobuf\Grpc\CommandFactory;
use Spiral\RoadRunner\GRPC\ContextInterface;

interface CorrelatedCommandFactory extends CommandFactory
{
    public function build(
        ContextInterface $context,
        Message $message,
    ): Command & Correlated;
}