<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\DependencyInjection\Compiler;

use RpHaven\Protobuf\Grpc\CommandFactory\CorrelationDecorator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final readonly class CommandFactoryDecorationPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container): void
    {
        $taggedCommandFactories = $container->findTaggedServiceIds('protobuf.command_factory');

        foreach ($taggedCommandFactories as $id => $tags) {
            $commandFactoryDefinition = $container->getDefinition($id);
            if (!$decorated = $commandFactoryDefinition->getDecoratedService()) {
                continue;
            }
            if ($commandFactoryDefinition->hasTag('protobuf.command_factory.decorator')) {
                $commandFactoryDefinition->setDecoratedService(null);
                $commandFactoryDefinition->addTag('container.ignore_attributes');
            }
        }
    }
}
