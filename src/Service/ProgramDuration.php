<?php

namespace App\Service;

use App\Entity\Program;
use App\Entity\Season;


class ProgramDuration
{
    public function calculate(Program $program): string
    {
            $seasons=$program->getSeasons();
            $duration = 0;
            foreach ($seasons as $season) {
                $episodes=$season->getEpisodes();
                foreach ($episodes as $episode) {
                    $duration += $episode->getDuration();
                }
            }

        $days = intdiv($duration, 1440);
        $hours = intdiv(($duration - $days*1440), 60);
        $minutes = $duration % 60;

        return $days . ' jour(s), ' . $hours . ' heure(s) et ' . $minutes . ' minute(s)';
    }
}
