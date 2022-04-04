<?php

namespace App\Tests\Unit\Factory;

use App\Factory\SingleManningFactory;
use App\Model\Rota;
use App\Model\Segment;
use App\Utils\SingleManningCalculator;
use PHPUnit\Framework\TestCase;

class SingleManningFactoryTest extends TestCase
{
    private SingleManningFactory $factory;

    private SingleManningCalculator $calculator;

    public function setUp(): void
    {
        $this->calculator = $this->getMockBuilder(SingleManningCalculator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new SingleManningFactory($this->calculator);
    }

    public function testCreate(): void
    {
        $segmentA = new Segment(1, 2);
        $segmentB = new Segment(2, 3);

        $rotaArray = [
            [$segmentA, $segmentB],
            [$segmentA],
            [$segmentA, $segmentB],
            [$segmentA],
            [$segmentA, $segmentB],
            [$segmentA],
            [$segmentA],
        ];

        $rota = new Rota(...$rotaArray);

        $this->calculator->method('calculate')
            ->withConsecutive(
                [
                    $rotaArray[0]
                ],
                [
                    $rotaArray[1]
                ],
                [
                    $rotaArray[2]
                ],
                [
                    $rotaArray[3]
                ],
                [
                    $rotaArray[4]
                ],
                [
                    $rotaArray[5]
                ],
                [
                    $rotaArray[6]
                ]
            )->willReturnOnConsecutiveCalls(3, 2, 3, 2, 3, 2, 2);

        $singleManning = $this->factory->create($rota);

        $this->assertJsonStringEqualsJsonString(
            json_encode(
                [
                    'monday' => 3,
                    'tuesday' => 2,
                    'wednesday' => 3,
                    'thursday' => 2,
                    'friday' => 3,
                    'saturday' => 2,
                    'sunday' => 2,
                ]
            ),
            json_encode($singleManning)
        );
    }
}
