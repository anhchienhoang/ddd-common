<?php

namespace DDDCommon\Tests\Fixtures;

use DDDCommon\AggregateId;
use DDDCommon\DomainEvent;

class TestEventWasTriggered implements DomainEvent
{
    /**
     * @var AggregateId
     */
    private $id;

    /**
     * @var string
     */
    private $payload;

    /**
     * @param AggregateId $id
     * @param string $payload
     */
    public function __construct(AggregateId $id, string $payload)
    {
        $this->id = $id;
        $this->payload = $payload;
    }

    public function getAggregateId(): AggregateId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }
}