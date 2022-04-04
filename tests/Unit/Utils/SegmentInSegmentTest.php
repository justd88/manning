<?php

namespace App\Tests\Unit\Utils;

use App\Model\Segment;
use App\Utils\SegmentInSegment;
use PHPUnit\Framework\TestCase;

class SegmentInSegmentTest extends TestCase
{
    private SegmentInSegment $segmentInSegment;

    public function setUp(): void
    {
        $this->segmentInSegment = new SegmentInSegment();
    }

    /**
     * @param $segmentA
     * @param $segmentB
     * @param $expected
     * @dataProvider segmentsDataProvider
     */
    public function testIsSegmentInSegment($segmentA, $segmentB, $expected): void
    {
        $this->assertSame($expected, $this->segmentInSegment->isSegmentInSegment($segmentA, $segmentB));
    }

    public function segmentsDataProvider(): array
    {
        return [
            'starts before, same end' => [new Segment(5, 10), new Segment(4, 10), true],
            'starts before, ending later' => [new Segment(5, 10), new Segment(4, 11), true],
            'same start, ending later' => [new Segment(5, 10), new Segment(5, 11), true],
            'same start, same end' => [new Segment(5, 10), new Segment(5, 10), true],
            'start later, same end' => [new Segment(5, 10), new Segment(6, 10), false],
            'same start, end earlier' => [new Segment(5, 10), new Segment(5, 9), false],
        ];
    }
}
