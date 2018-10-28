<?php

namespace DDDCommon\Tests;

use DDDCommon\AggregateId;
use DDDCommon\AggregateRepository;
use DDDCommon\RecordsEvents;
use DDDCommon\Tests\Fixtures\TestId;
use DDDCommon\Tests\Fixtures\TestModel;
use PHPUnit\Framework\TestCase;

class AggregateRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldImplementTheInterface()
    {
        $repository = new TestRepository();

        $this->assertTrue($repository->add(TestModel::createEmptyWithId(TestId::generate())));

        $model = $repository->get(TestId::fromString('123'));

        $this->assertEquals('123', $model->id);
    }
}

class TestRepository implements AggregateRepository
{
    public function add(RecordsEvents $aggregate)
    {
        return true;
    }

    public function get(AggregateId $id): RecordsEvents
    {
        return TestModel::createEmptyWithId($id);
    }
}