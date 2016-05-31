<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Damage {
    const ALIVE = 'alive';
    const DEAD = 'dead';

    /**
     * Damage I have caused to the enemy
     * @return int
     */
    public function done(): int;

    /**
     * Damage I have taken from the enemy
     * @return int
     */
    public function taken(): int;

    /**
     * Is the enemy dead or still alive?
     * @return string
     */
    public function consequence(): string;
}