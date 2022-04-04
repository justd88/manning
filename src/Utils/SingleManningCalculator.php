<?php

namespace App\Utils;

use App\Model\SegmentInterface;

class SingleManningCalculator
{
    public function __construct(
        private SegmentsMerger $segmentsMerger,
        private SegmentInSegment $segmentInSegment
    ) {
    }

    /**
     * @param SegmentInterface[] $shifts
     * @return int
     */
    public function calculate(array $shifts): int
    {
        $segmentedTimeline = $this->segmentsMerger->merge(...$shifts);

        $duration = 0;
        foreach ($segmentedTimeline as $segment) {
            $segmentCoveredByShift = 0;
            foreach ($shifts as $shift) {
                if ($this->segmentInSegment->isSegmentInSegment($segment, $shift)) {
                    $segmentCoveredByShift++;
                    if (1 < $segmentCoveredByShift) {
                        break;
                    }
                }
            }

            if (1 === $segmentCoveredByShift) {
                $duration += $segment->getEnd() - $segment->getStart();
            }
        }

        return $duration;
    }
}
