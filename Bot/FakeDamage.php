<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class FakeDamage implements Damage {
    private $done;
    private $taken;

    public function __construct(int $done = null, int $taken = null) {
        $this->done = $done;
        $this->taken = $taken;
    }

    public function done(): int {
        return $this->done;
    }

    public function taken(): int {
        return $this->taken;
    }

    public function consequence(): string {

    }

}