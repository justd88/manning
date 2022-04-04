<?php

namespace App\Model;

interface SegmentInterface
{
    public function getStart(): int;

    public function getEnd(): int;
}