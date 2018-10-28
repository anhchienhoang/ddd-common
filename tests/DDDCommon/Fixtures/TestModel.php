<?php

namespace DDDCommon\Tests\Fixtures;

use DDDCommon\AggregateId;
use DDDCommon\AggregateRoot;
use DDDCommon\DomainEventsHistory;

class TestModel extends AggregateRoot
{
    public $id;

    public $payload;

    public static function createEmptyWithId(AggregateId $id)
    {
        return new TestModel($id);
    }

    public static function reconstituteFromHistory(DomainEventsHistory $eventsHistory)
    {
        $model = new static($eventsHistory->getAggregateId());

        foreach ($eventsHistory as $event) {
            $model->apply($event);
        }

        return $model;
    }

    public function changePayload(string $payload)
    {
        $this->applyAndRecordThat(new TestEventWasTriggered($this->id, $payload));
    }

    protected function applyTestEventWasTriggered(TestEventWasTriggered $event)
    {
        $this->payload = $event->getPayload();
    }

    private function __construct(AggregateId $id)
    {
        $this->id = $id;
    }
}