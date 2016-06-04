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
    public function testActual() {
        $dom = new \DOMDocument();
        @$dom->loadHTML('<span class="count" id="levelCount">4</span>');
        Assert::same(
            4,
            (new Bot\HtmlExperiences($dom))->actual()
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
