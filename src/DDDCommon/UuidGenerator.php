<?php

namespace DDDCommon;

use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    public static function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}
