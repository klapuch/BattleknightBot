<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

use GuzzleHttp;

final class HtmlKnight implements Knight {
    private $dom;
    private $name;
    private $http;

    public function __construct(
        \DOMDocument $dom,
        string $name,
        GuzzleHttp\ClientInterface $http
    ) {
        $this->dom = $dom;
        $this->name = $name;
        $this->http = $http;
    }

    public function attack(Enemy $enemy): Duel {
        $result = $this->http->request(
            'GET',
            sprintf('duel/duel/?enemyID=%d', $enemy->id())
        );
        @$this->dom->loadHTML((string)$result->getBody());
        $domX = new \DOMXPath($this->dom);
        return new HtmlDuel($domX, new HtmlDamage($domX));
    }

    public function name(): string {
        return $this->name;
    }

    public function life(): int {
        return (int)$this->dom->getElementById('lifeCount')->nodeValue;
    }

    public function experiences(): Experiences {
        return new HtmlExperiences($this->dom);
    }

    public function silvers(): int {
        return (int)$this->dom->getElementById('silverCount')->nodeValue;
    }
}