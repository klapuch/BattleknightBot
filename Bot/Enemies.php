<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Enemies {
    /**
     * Go through all enemies
     * @return Enemy[]
     */
    public function iterate(): array;

    /**
     * Make a new enemy
     * @param Enemy $enemy
     * @return void
     */
    public function make(Enemy $enemy);

    /**
     * Move enemy to the bottom of all the enemies
     * @param Enemy $enemy
     * @throws \UnexpectedValueException
     * @return void
     */
    public function toBottom(Enemy $enemy);
}