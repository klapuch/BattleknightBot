<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class HtmlExperiences implements Experiences {
    private $dom;

    public function __construct(\DOMDocument $dom) {
        $this->dom = $dom;
    }

    public function actual(): int {
        return (int)$this->dom->getElementById('levelCount')->nodeValue;
    }

    public function max(): int {
        $level = (int)$this->dom->getElementById('userLevel')->nodeValue;
        return 5 * ($level ** 2);
    }
}