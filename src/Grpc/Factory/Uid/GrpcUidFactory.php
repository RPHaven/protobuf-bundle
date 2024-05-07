<?php

declare(strict_types=1);

namespace Rphaven\Common\Utils\Factory\Uid;

use Rphaven\Common\V1\Uid as GrpcUid;
use RpHaven\Uid\Factory\UidFactory;
use RpHaven\Uid\Uid;

interface GrpcUidFactory
{
    public function fromGrpc(GrpcUid $uid, UidFactory $uidFactory): Uid;

    public function toGrpc(Uid $uid): GrpcUid;

    public function supportsGrpcUid(GrpcUid $uid): bool;

    public function supportsUid(Uid $uid): bool;
}