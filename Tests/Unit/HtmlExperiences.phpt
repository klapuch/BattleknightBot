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

final class HtmlExperiences extends Tester\TestCase {
    private $dom;

    public function setUp() {
        parent::setUp();
        $this->dom = new \DOMDocument();
        @$this->dom->loadHTMLFile(__DIR__ . '/../fight.html');
    }

    public function testActual() {
        Assert::same(
            4,
            (new Bot\HtmlExperiences($this->dom))->actual()
        );
    }

    public function testMax() {
        $dom = new \DOMDocument();
        @$dom->loadHTML('<div id="userLevel"><span>9</span></div>');
        Assert::same(
            405,
            (new Bot\HtmlExperiences($dom))->max()
        );
    }
}


(new HtmlExperiences())->run();
