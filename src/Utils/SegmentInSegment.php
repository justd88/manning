<?php

namespace App\Utils;

use App\Model\SegmentInterface;

class SegmentInSegment
{
    public function isSegmentInSegment(SegmentInterface $segmentA, SegmentInterface $segmentB): bool
    {
        return $segmentB->getStart() <= $segmentA->getStart() && $segmentB->getEnd() >= $segmentA->getEnd();
    }
}
