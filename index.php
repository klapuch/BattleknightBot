<?php
declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use Battleknight\Bot;
use Klapuch\Ini;

define('SETTING', __DIR__ . '/Configuration/config.ini');
define('ENEMIES', __DIR__ . '/Configuration/enemies.ini');
$setting = (new Ini\Valid(SETTING, new Ini\Typed(SETTING)))->read();
$http = new GuzzleHttp\Client([
    'base_uri' => $setting['url'],
    'allow_redirects' => true,
    'cookies' => new GuzzleHttp\Cookie\FileCookieJar($setting['cookie']),
]);
try {
    $enemies = new Bot\IniEnemies(new Ini\Valid(ENEMIES, new Ini\Typed(ENEMIES)));
    foreach($enemies->iterate() as $enemy) {
        $knight = (new Bot\HttpEntrance($http))->enter(
            $setting['username'],
            $setting['password']
        );
        $duel = $knight->attack($enemy);
        $enemies->toBottom($enemy);
        if($duel->draw())
            throw new \Exception('Draw - nobody wins');
        printf(
            '%s won %d silvers and %d experiences',
            $duel->winner(),
            $duel->loot()->silvers(),
            $duel->loot()->experience()->value()
        );
        echo "\r\n";
        printf(
            'You have done %d damage and enemy to you %d',
            $duel->damage()->done(),
            $duel->damage()->taken()
        );
        echo "\r\n";
        printf(
            'After fight you have %d life, %d experiences and %d silvers',
            $knight->life(),
            $knight->experiences()->actual(),
            $knight->silvers()
        );
    }
} catch(\Throwable $ex) {
    echo $ex->getMessage();
} finally {
    echo "\r\n";
    printf('Waiting to next fight for %d seconds...', $setting['break']);
    echo "\r\n";
    sleep($setting['break'] + random_int(10, 20));
}