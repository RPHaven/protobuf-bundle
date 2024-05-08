<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\DependencyInjection\Compiler;

use RpHaven\Protobuf\Grpc\CommandFactory\CorrelationDecorator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\DecoratorServicePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final readonly class CommandFactoryDecorationPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('protobuf.command_factory.decorator');

        foreach ($taggedServices as $id => $tags) {
            $container->getDefinition($id)->setDecoratedService(null);
        }
    }
}