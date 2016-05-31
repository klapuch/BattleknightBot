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

final class ConstantEnemy extends Tester\TestCase {
    public function testId() {
        Assert::same(
            123,
            (new Bot\ConstantEnemy(123, 'foo'))->id()
        );
    }

    public function testName() {
        Assert::same(
            'foo',
            (new Bot\ConstantEnemy(123, 'foo'))->name()
        );
    }
}


(new ConstantEnemy())->run();
