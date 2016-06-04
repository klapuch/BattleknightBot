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
        @$dom->loadHTML(
            '<div class="fightResultsInner">
                <h1><em>facedown vyhrává</em></h1>
                <p>facedown získává <em>10</em> stříbra</p>
                <p>facedown obdrží <em>2</em> ZB</p>
                <p>Someone obdrží <em>0</em> ZB</p>
                <div class="divider"></div>
                <p>Zranění - útočník: <em>13</em></p>
                <p>Zranění - obránce: <em>2</em></p>
            </div>'
        );
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
