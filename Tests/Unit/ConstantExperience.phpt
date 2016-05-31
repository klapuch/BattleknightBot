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

final class ConstantExperience extends Tester\TestCase {
    protected function experiences() {
        return [
            [-4, -3],
            [-3, -3],
            [-2, -2],
            [-1, -1],
            [0, 0],
            [1, 1],
            [2, 2],
            [3, 3],
            [4, 3],
        ];
    }

    /**
     * @dataProvider experiences
     */
    public function testAllPossibilities($actual, $expected) {
        Assert::same(
            $expected,
            (new Bot\ConstantExperience($actual))->value()
        );
    }
}


(new ConstantExperience())->run();
