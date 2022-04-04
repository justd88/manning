<?php

namespace App\Factory;

use App\Model\Segment;

class SegmentFactory
{
    public function create(int $start, int $end): Segment
    {
        return new Segment($start, $end);
    }
}