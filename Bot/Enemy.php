<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Enemy {
    /**
     * Unique ID of the enemy
     * @return int
     */
    public function id(): int;

    /**
     * Name of the enemy
     * @return string
     */
    public function name(): string;
}