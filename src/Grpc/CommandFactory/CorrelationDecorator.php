<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Grpc\CommandFactory;

use Google\Protobuf\Internal\Message;
use RpHaven\App\Message\Command;
use RpHaven\App\Message\Correlated;
use RpHaven\Protobuf\Grpc\CommandFactory;
use RpHaven\Protobuf\Grpc\CommandFactory\Exception\UnableToCreateCorrelation;
use RpHaven\Protobuf\Grpc\Factory\CorrelationFactory;
use Spiral\RoadRunner\GRPC\ContextInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: CommandFactory::class, priority: 5)]
final readonly class CorrelationDecorator implements CommandFactory
{

    public function __construct(
        private CommandFactory $innerCommandFactory,
        private CorrelationFactory $correlationFactory,
    ) {

    }

    public function build(ContextInterface $context, Message $message): Command
    {
        $command = $this->innerCommandFactory->build($context, $message);
        if ($command instanceof Correlated) {
            $command = $this->correlate($command, $message);
        }

        return $command;
    }

    private function correlate(Correlated & Command $correlated, Message $message): Correlated & Command
    {
        if (!$correlation = $this->correlationFactory->fromGrpcMessage($message)) {
            throw new UnableToCreateCorrelation($correlated, $message);
        }

        /** @var Command & Correlated */
        return $correlated->withCorrelation($correlation);
    }
}