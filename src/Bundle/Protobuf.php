<?php

declare(strict_types=1);

namespace RpHaven\Protobuf\Bundle;

use RpHaven\Protobuf\DependencyInjection\ProtobufExtension;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class Protobuf extends ABstractBundle
{
    public function getContainerExtension(): ProtobufExtension
    {
        return new ProtobufExtension();
    }
}
