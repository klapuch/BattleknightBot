<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

use Klapuch\Ini;

final class IniEnemies implements Enemies {
    private $ini;

    public function __construct(Ini\Ini $ini) {
        $this->ini = $ini;
    }

    public function iterate(): array {
        $enemies = $this->ini->read();
        return array_reduce(
            array_keys($enemies),
            function($previous, $id) use($enemies) {
                $previous[] = new ConstantEnemy($id, $enemies[$id]);
                return $previous;
            }
        );
    }

    public function make(Enemy $enemy) {
        $this->ini->write([$enemy->id() => $enemy->name()]);
    }

    public function toBottom(Enemy $enemy): Enemies {
        $exists = array_filter(
            $this->iterate(),
            function(Enemy $iniEnemy) use($enemy) {
                return $iniEnemy->id() === $enemy->id();
            }
        );
        if(!$exists)
            throw new \UnexpectedValueException('Enemy is not in the list');
        $this->ini->remove($enemy->id());
        $this->ini->write([$enemy->id() => $enemy->name()]);
        return $this;
    }
}