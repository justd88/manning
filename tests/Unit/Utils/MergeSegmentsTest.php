<?php

namespace App\Tests\Unit\Utils;

use App\Factory\SegmentFactory;
use App\Model\Segment;
use App\Utils\MergeSegments;
use PHPUnit\Framework\TestCase;

class MergeSegmentsTest extends TestCase
{
    private MergeSegments $mergeSegments;

    private SegmentFactory $segmentFactory;

    public function setUp(): void
    {
        $this->segmentFactory = $this->getMockBuilder(SegmentFactory::class)->getMock();
        $this->mergeSegments = new MergeSegments($this->segmentFactory);
    }

    public function testSingleSegment(): void
    {
        $segments = [
            new Segment(3, 10),
        ];
        $expected = [
            new Segment(3, 10),
        ];
        $this->segmentFactory->expects($this->once())
            ->method('create')
            ->with(3, 10)
            ->willReturn($expected[0]);

        $this->assertSame($expected, $this->mergeSegments->merge(...$segments));
    }

    public function testMultiSegmentMerge(): void
    {
        $segments = [
            new Segment(3, 10),
            new Segment(6, 11),
        ];

        $expected = [
            new Segment(3, 6),
            new Segment(6, 10),
            new Segment(10, 11),
        ];

        $this->segmentFactory->method('create')
            ->withConsecutive(
                [3, 6],
                [6, 10],
                [10, 11],
            )->willReturnOnConsecutiveCalls(
                $expected[0],
                $expected[1],
                $expected[2]
            );

        $this->assertEquals($expected, $this->mergeSegments->merge(...$segments));
    }
}
