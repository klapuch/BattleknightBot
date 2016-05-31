<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class ConstantEnemy implements Enemy {
    private $id;
    private $name;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): int {
        return $this->id;
    }

    public function name(): string {
        return $this->name;
    }
}