<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\DependencyInjection;

use RpHaven\Protobuf\Grpc\CommandFactory;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class ProtobufExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(dirname(__DIR__, 2) . '/config')
        );

        $loader->load('protobuf.yaml');

        $container->registerForAutoconfiguration(CommandFactory::class)
            ->addTag('protobuf.command_factory');

    }
}