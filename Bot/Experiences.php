<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

interface Experiences {
    /**
     * How many experiences I currently have?
     * @return int
     */
    public function actual(): int;

    /**
     * What is the maximum of the experiences in this level?
     * @return int
     */
    public function max(): int;
}