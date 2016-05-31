<?php
/**
 * @testCase
 * @phpVersion > 7.0.0
 */
namespace Klapuch\Unit;

use Tester,
    Tester\Assert;

use Battleknight\Bot;

require __DIR__ . '/../bootstrap.php';

final class HtmlDuel extends Tester\TestCase {
    private $domX;

    public function setUp() {
        parent::setUp();
        $dom = new \DOMDocument();
        @$dom->loadHTMLFile(__DIR__ . '/../fight.html');
        $this->domX = new \DOMXPath($dom);
    }

    public function testLoot() {
        Assert::equal(
            new Bot\HtmlLoot($this->domX),
            (new Bot\HtmlDuel($this->domX, new Bot\FakeDamage))->loot()
        );
    }

    public function testDamage() {
        Assert::equal(
            new Bot\HtmlDamage($this->domX),
            (new Bot\HtmlDuel($this->domX, new Bot\FakeDamage))->damage()
        );
    }
    
    public function testDraw() {
        $duel = new Bot\HtmlDuel($this->domX, new Bot\FakeDamage(5, 5));
        Assert::true($duel->draw());
        Assert::exception(
            function() use ($duel) {
                $duel->winner();
            },\LogicException::class, 'Draw - nobody is winner'
        );
        Assert::exception(
            function() use ($duel) {
                $duel->looser();
            },\LogicException::class, 'Draw - nobody is looser'
        );
    }

    public function testThatSomeoneWin() {
        Assert::false(
            (new Bot\HtmlDuel($this->domX, new Bot\FakeDamage(5, 6)))->draw()
        );
    }

    public function testWinner() {
        Assert::same(
            'facedown',
            (new Bot\HtmlDuel($this->domX, new Bot\FakeDamage(6, 5)))->winner()
        );
    }

    public function testLooser() {
        Assert::same(
            'Suschi',
            (new Bot\HtmlDuel($this->domX, new Bot\FakeDamage(5, 6)))->looser()
        );
    }
}


(new HtmlDuel())->run();
