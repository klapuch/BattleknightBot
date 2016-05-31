<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class ConstantExperience implements Experience {
    const MINIMUM = -3;
    const MAXIMUM = 3;
    private $value;

    public function __construct(int $value) {
        $this->value = $value;
    }

    public function value(): int {
        return min(max($this->value, self::MINIMUM), self::MAXIMUM);
    }
}