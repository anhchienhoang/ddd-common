<?php

namespace DDDCommon\Tests;

use DDDCommon\AbstractProjection;
use DDDCommon\DomainEvents;
use DDDCommon\Tests\Fixtures\TestEventWasTriggered;
use DDDCommon\Tests\Fixtures\TestId;
use PHPUnit\Framework\TestCase;

class ProjectionTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldRunProjectionWhenAnEventTriggered()
    {
        $event = new TestEventWasTriggered(TestId::fromString('123'), 'test');

        $events = new DomainEvents([
            $event
        ]);

        $projection = new TestProjection();

        $projection->project($events);

        $this->assertEquals('123', $projection->id);
        $this->assertEquals('test', $projection->payload);
    }
}

class TestProjection extends AbstractProjection
{
    public $id;
    public $payload;

    public function projectWhenTestEventWasTriggered(TestEventWasTriggered $event)
    {
        $this->id = $event->getAggregateId();
        $this->payload = $event->getPayload();
    }
}