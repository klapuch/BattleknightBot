<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class HtmlDamage implements Damage {
    const DONE = 3;
    const TAKEN = 4;
    private $domX;

    public function __construct(\DOMXPath $domX) {
        $this->domX = $domX;
    }

    public function done(): int {
        return $this->damages()[self::DONE];
    }

    public function taken(): int {
        return $this->damages()[self::TAKEN];
    }

    //TODO
    public function consequence(): string {
        return self::ALIVE;
    }

    /**
     * Damages I have caused and taken
     * @return array
     */
    private function damages(): array {
        return array_map(
            function ($value) {
                return abs(filter_var($value, FILTER_SANITIZE_NUMBER_INT));
            },
            array_reduce(
                iterator_to_array(
                    $this->domX->query("//div[@class='fightResultsInner']/p")
                ),
                function ($previous, $current) {
                    $previous[] = $current->nodeValue;
                    return $previous;
                }
            )
        );
    }
}