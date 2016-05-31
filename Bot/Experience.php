<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Experience {
    /**
     * Value of the experience
     * @return int
     */
    public function value(): int;
}