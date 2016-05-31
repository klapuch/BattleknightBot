<?php
/**
 * @testCase
 * @phpVersion > 7.0.0
 */
namespace Klapuch\Unit;

use Tester,
    Tester\Assert;

use Battleknight\Bot;
use Klapuch\Ini;

require __DIR__ . '/../bootstrap.php';

final class IniEnemies extends Tester\TestCase {
    public function testIterating() {
        $ini = new Ini\Fake([1234 => 'foo', 6789 => 'bar']);
        Assert::equal(
            [
                new Bot\ConstantEnemy(1234, 'foo'),
                new Bot\ConstantEnemy(6789, 'bar'),
            ],
            (new Bot\IniEnemies($ini))->iterate()
        );
    }

    public function testMakingANewEnemy() {
        $ini = new Ini\Fake([1234 => 'foo', 6789 => 'bar']);
        $enemies = new Bot\IniEnemies($ini);
        $enemies->make(new Bot\ConstantEnemy(1, 'someone'));
        Assert::equal(
            [
                new Bot\ConstantEnemy(1234, 'foo'),
                new Bot\ConstantEnemy(6789, 'bar'),
                new Bot\ConstantEnemy(1, 'someone'),
            ],
            $enemies->iterate()
        );
    }

    public function testPostponingEnemy() {
        Tester\Environment::skip('Not implemented yet');
        $ini = new Ini\Fake([1234 => 'foo', 6789 => 'bar', 666 => 'middle']);
        $enemies = new Bot\IniEnemies($ini);
        $enemies->toBottom(new Bot\ConstantEnemy(1234, 'foo'));
        Assert::equal(
            [
                new Bot\ConstantEnemy(6789, 'bar'),
                new Bot\ConstantEnemy(666, 'middle'),
                new Bot\ConstantEnemy(1234, 'foo'),
            ],
            $enemies->iterate()
        );
    }

    /**
     * @throws \UnexpectedValueException Enemy is not in the list
     */
    public function testMovingToTheBottomUnknownEnemy() {
        $ini = new Ini\Fake([1234 => 'foo', 6789 => 'bar']);
        (new Bot\IniEnemies($ini))->toBottom(new Bot\ConstantEnemy(666, 'foo'));
    }
}


(new IniEnemies())->run();
