<?php

namespace App\Model;

use ArrayIterator;
use IteratorAggregate;
use JsonSerializable;

class SingleManning implements JsonSerializable, IteratorAggregate
{
    public function __construct(
        public int $monday = 0,
        public int $tuesday = 0,
        public int $wednesday = 0,
        public int $thursday = 0,
        public int $friday = 0,
        public int $saturday = 0,
        public int $sunday = 0)
    {
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }
}