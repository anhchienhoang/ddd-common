<?php

namespace DDDCommon;

interface DomainEvent
{
    public function getAggregateId(): AggregateId;
}
