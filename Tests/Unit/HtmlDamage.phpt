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

final class HtmlDamage extends Tester\TestCase {
    private $domX;

    public function setUp() {
        parent::setUp();
        $dom = new \DOMDocument();
        @$dom->loadHTMLFile(__DIR__ . '/../fight.html');
        $this->domX = new \DOMXPath($dom);
    }

    public function testDamageDone() {
        Assert::same(
            13,
            (new Bot\HtmlDamage($this->domX))->done()
        );
    }

    public function testDamageTaken() {
        Assert::same(
            2,
            (new Bot\HtmlDamage($this->domX))->taken()
        );
    }
}


(new HtmlDamage())->run();
