<?php

namespace DDDCommon;

interface RecordsEvents
{
    public function getRecordedEvents(): DomainEvents;

    public function clearRecordedEvents();
}
