<?php

namespace DDDCommon\Tests;

use DDDCommon\Tests\Fixtures\TestId;
use PHPUnit\Framework\TestCase;

class AggregateIdTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldImplementTheInterface()
    {
        $testId = TestId::generate();

        $testId2 = TestId::generate();

        $this->assertTrue($testId->equals($testId));
        $this->assertFalse($testId->equals($testId2));

        $testId3 = TestId::fromString('123');
        $this->assertEquals('123', (string)$testId3);
    }
}