<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class HtmlLoot implements Loot {
    const SILVER = 0;
    const EXPERIENCE = 1;
    private $domX;

    public function __construct(\DOMXPath $domX) {
        $this->domX = $domX;
    }

    public function silvers(): int {
        return $this->loots()[self::SILVER];
    }

    public function experience(): Experience {
        return new ConstantExperience($this->loots()[self::EXPERIENCE]);
    }

    /**
     * Loots as a silvers or experiences
     * @return array
     */
    private function loots(): array {
        return array_map(
            function ($value) {
                return (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
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