<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

final class HtmlDuel implements Duel {
    const ATTACKER = 'profileImage';
    const DEFENDER = 'opponentImage';
    private $domX;
    private $damage;

    public function __construct(\DOMXPath $domX, Damage $damage) {
        $this->domX = $domX;
        $this->damage = $damage;
    }

    public function winner(): string {
        if($this->draw())
            throw new \LogicException('Draw - nobody is winner');
        if($this->damage->done() > $this->damage->taken())
            return $this->knight(self::ATTACKER);
        return $this->knight(self::DEFENDER);
    }

    public function looser(): string {
        if($this->draw())
            throw new \LogicException('Draw - nobody is looser');
        if($this->damage->done() < $this->damage->taken())
            return $this->knight(self::DEFENDER);
        return $this->knight(self::ATTACKER);
    }

    public function draw(): bool {
        return $this->damage->done() === $this->damage->taken();
    }

    public function loot(): Loot {
        return new HtmlLoot($this->domX);
    }

    public function damage(): Damage {
        return new HtmlDamage($this->domX);
    }

    /**
     * Side of the knight - attacker or defender?
     * @param string $side
     * @return mixed
     */
    private function knight(string $side): string {
        $titleWithName = $this->domX->query(
            sprintf("//div[@id='%s']/h2", $side)
        )[0]->nodeValue;
        return explode(' ', $titleWithName, 2)[1];

    }
}