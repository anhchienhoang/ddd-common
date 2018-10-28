<?php

namespace DDDCommon\Tests;

use DDDCommon\AggregateId;
use DDDCommon\DomainEvents;
use DDDCommon\DomainEventsHistory;
use DDDCommon\EventStore;
use DDDCommon\Tests\Fixtures\TestEventWasTriggered;
use DDDCommon\Tests\Fixtures\TestId;
use PHPUnit\Framework\TestCase;

class EventStoreTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldImplementTheInterface()
    {
        $eventStore = new TestEventStore();

        $this->assertTrue($eventStore->append(new DomainEvents([])));

        $events = $eventStore->get(TestId::fromString('123'));

        $this->assertEquals('123', $events->getAggregateId());
    }
}

class TestEventStore implements EventStore
{
    public function append(DomainEvents $events)
    {
        return true;
    }

    public function get(AggregateId $aggregateId): DomainEventsHistory
    {
        $event = new TestEventWasTriggered(TestId::fromString('123'), 'test');

        return new DomainEventsHistory(
            $aggregateId,
            [
                $event,
            ]
        );
    }
}