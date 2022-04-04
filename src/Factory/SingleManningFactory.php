<?php

namespace App\Factory;

use App\Model\Rota;
use App\Model\SingleManning;
use App\Utils\SingleManningCalculator;

class SingleManningFactory
{
    public function __construct(
        private SingleManningCalculator $singleManningCalculator
    )
    {
    }

    public function create(Rota $rota): SingleManning
    {
        $weekdays = [];
        foreach ($rota as $day => $shifts) {
            $weekdays[$day] = $this->singleManningCalculator->calculate($shifts);
        }
        return new SingleManning(
            $weekdays['monday'],
            $weekdays['tuesday'],
            $weekdays['wednesday'],
            $weekdays['thursday'],
            $weekdays['friday'],
            $weekdays['saturday'],
            $weekdays['sunday'],
        );
    }
}