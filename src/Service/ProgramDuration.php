<?php

namespace App\Service;

use App\Entity\Program;
use App\Entity\Season;


class ProgramDuration
{
    public function calculate(Program $program): string
    {
        $durationInMinutes = 1610;

        $duration = [0,0,0];

        $days = intdiv($durationInMinutes, 1440);
        $hours = intdiv(($durationInMinutes - $days*1440), 60);
        $minutes = $durationInMinutes % 60;

        return $days . ' jour(s), ' . $hours . ' heure(s) et ' . $minutes . ' minute(s)';
    }
}
