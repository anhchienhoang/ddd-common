<?php

namespace DDDCommon\Tests;

use DDDCommon\DomainEvents;
use DDDCommon\DomainEventsHistory;
use DDDCommon\Tests\Fixtures\TestEventWasTriggered;
use DDDCommon\Tests\Fixtures\TestId;
use DDDCommon\Tests\Fixtures\TestModel;
use PHPUnit\Framework\TestCase;

class AggregateRootTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldApplyAndRecordTheEvent()
    {
        $model = TestModel::createEmptyWithId(TestId::fromString('123'));
        $model->changePayload('test');

        $this->assertTrue($this->assertEvent($model));

        $this->assertEquals('123', $model->id);
        $this->assertEquals('test', $model->payload);

    }

    /**
     * @test
     */
    public function itShouldBeReconstitutedFromHistory()
    {
        $event = new TestEventWasTriggered(TestId::fromString('123'), 'test');

        $events = new DomainEventsHistory(
            TestId::fromString('123'),
            [
                $event,
            ]
        );

        $model = TestModel::reconstituteFromHistory($events);

        $this->assertEquals('123', (string)$model->id);
        $this->assertEquals('test', $model->payload);
    }

    /**
     * @param TestModel $model
     * @return bool
     */
    private function assertEvent(TestModel $model): bool
    {
        foreach ($model->getRecordedEvents() as $event) {
            if ($event instanceof TestEventWasTriggered) {
                return true;
            }
        }

        return false;
    }
}