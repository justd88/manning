<?php

namespace App\Utils;

use App\Factory\SegmentFactory;
use App\Model\SegmentInterface;

class MergeSegments
{
    public function __construct(private SegmentFactory $segmentFactory)
    {
    }

    /**
     * @param SegmentInterface[] $segments
     * @return SegmentInterface[]
     */
    public function merge(SegmentInterface ...$segments): array
    {
        if (1 === count($segments)) {
            return [
                $this->segmentFactory->create($segments[0]->getStart(), $segments[0]->getEnd())
            ];
        }

        $points = $this->flattenSegmentsPoints($segments);

        sort($points);

        $mergedSegments = [];
        for ($i = 0; $i <= count($points) / 2; $i++) {
            $mergedSegments[] = $this->segmentFactory->create($points[$i], $points[$i + 1]);
        }
        return $mergedSegments;
    }

    private function flattenSegmentsPoints(array $segments): array
    {
        $points = [];
        foreach ($segments as $shift) {
            $points[] = $shift->getStart();
            $points[] = $shift->getEnd();
        }
        return $points;
    }
}