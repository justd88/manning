<?php

namespace App\Tests\Integration\Utils;

use App\Model\Segment;
use App\Utils\SingleManningCalculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SingleManningCalculatorTest extends KernelTestCase
{
    private $singleManningCalculator;

    public function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();

        $this->singleManningCalculator = $container->get(SingleManningCalculator::class);
    }

    /**
     * @param array $shifts
     * @param int $expected
     * @dataProvider calculateDataProvider
     */
    public function testCalculate(array $shifts, int $expected): void
    {
        $this->assertSame($expected, $this->singleManningCalculator->calculate($shifts));
    }

    public function calculateDataProvider(): array
    {
        return [
            'Scenario One - Single Shift' => [
                [
                    new Segment(0, 22)
                ],
                22
            ],
            'Scenario Two - After Each Other' => [
                [
                    new Segment(0, 10),
                    new Segment(10, 23)
                ],
                23
            ],
            'Scenario Three - Lap over' => [
                [
                    new Segment(0, 12),
                    new Segment(10, 27)
                ],
                25
            ],
        ];
    }
}
