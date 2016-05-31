<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Loot {
    /**
     * Silvers I have gain
     * @return int
     */
    public function silvers(): int;

    /**
     * Experience I have gain
     * @return Experience
     */
    public function experience(): Experience;
}