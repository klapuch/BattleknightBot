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

final class HtmlLoot extends Tester\TestCase {
    private $domX;

    public function setUp() {
        parent::setUp();
        $dom = new \DOMDocument();
        @$dom->loadHTMLFile(__DIR__ . '/../fight.html');
        $this->domX = new \DOMXPath($dom);
    }

    public function testExperiences() {
        Assert::equal(
            new Bot\ConstantExperience(2),
            (new Bot\HtmlLoot($this->domX))->experience()
        );
    }

    public function testSilvers() {
        Assert::same(
            10,
            (new Bot\HtmlLoot($this->domX))->silvers()
        );
    }
}


(new HtmlLoot())->run();
