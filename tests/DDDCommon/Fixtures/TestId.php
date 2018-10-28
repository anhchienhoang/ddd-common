<?php

namespace DDDCommon\Tests\Fixtures;

use DDDCommon\AggregateId;
use DDDCommon\UuidGenerator;

class TestId implements AggregateId
{
    private $id;

    public static function fromString(string $id)
    {
        return new TestId($id);
    }

    public function __toString()
    {
        return (string)$this->id;
    }

    public function equals(AggregateId $other)
    {
        return $this->id === $other->id;
    }

    public static function generate(): TestId
    {
        return new TestId(UuidGenerator::generate());
    }

    private function __construct(string $id)
    {
        $this->id = $id;
    }
}