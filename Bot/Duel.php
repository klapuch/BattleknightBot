<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Duel {
    /**
     * Name of the knight who wins
     * @throws \LogicException
     * @return string
     */
    public function winner(): string;

    /**
     * Name of the knight who looses
     * @throws \LogicException
     * @return string
     */
    public function looser(): string;

    /**
     * Is the duel draw and there is no winner or looser?
     * @return bool
     */
    public function draw(): bool;

    /**
     * Loot I have gain from the duel
     * @return Loot
     */
    public function loot(): Loot;

    /**
     * Damage I have caused or taken
     * @return Damage
     */
    public function damage(): Damage;
}