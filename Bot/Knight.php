<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Knight {
    /**
     * Attack to the enemy by name
     * @param Enemy $enemy
     * @return Duel
     */
    public function attack(Enemy $enemy): Duel;

    /**
     * Name
     * @return string
     */
    public function name(): string;

    /**
     * Life
     * @return int
     */
    public function life(): int;

    /**
     * Experiences
     * @return Experiences
     */
    public function experiences(): Experiences;

    /**
     * Silvers
     * @return int
     */
    public function silvers(): int;
}