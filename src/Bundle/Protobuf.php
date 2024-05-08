<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Bundle;

use RpHaven\Protobuf\DependencyInjection\Compiler\CommandFactoryDecorationPass;
use RpHaven\Protobuf\DependencyInjection\ProtobufExtension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class Protobuf extends ABstractBundle
{
    public function getContainerExtension(): ProtobufExtension
    {
        return new ProtobufExtension();
    }

    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new CommandFactoryDecorationPass());
        parent::build($container);
    }
}
