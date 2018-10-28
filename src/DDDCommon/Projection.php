<?php

namespace DDDCommon;

interface Projection
{
    public function project(DomainEvents $events);
}
