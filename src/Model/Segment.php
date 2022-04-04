<?php

namespace App\Model;

class Segment implements SegmentInterface
{
    public function __construct(
        private int $start,
        private int $end
    ) {
    }

    public function getStart(): int
    {
        return $this->start;
    }

    public function getEnd(): int
    {
        return $this->end;
    }
}
