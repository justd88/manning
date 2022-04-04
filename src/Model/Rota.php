<?php

namespace App\Model;

use ArrayIterator;
use IteratorAggregate;

class Rota implements IteratorAggregate
{
    /**
     * Rota constructor.
     * @param SegmentInterface[] $monday
     * @param SegmentInterface[] $tuesday
     * @param SegmentInterface[] $wednesday
     * @param SegmentInterface[] $thursday
     * @param SegmentInterface[] $friday
     * @param SegmentInterface[] $saturday
     * @param SegmentInterface[] $sunday
     */
    public function __construct(
        public array $monday = [],
        public array $tuesday = [],
        public array $wednesday = [],
        public array $thursday = [],
        public array $friday = [],
        public array $saturday = [],
        public array $sunday = []
    ) {
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this);
    }
}
