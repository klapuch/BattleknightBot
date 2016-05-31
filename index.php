<?php
declare(strict_types = 1);

require __DIR__ . '/vendor/autoload.php';

use Battleknight\Bot;
use Klapuch\Ini;

define('SETTING', __DIR__ . '/Configuration/config.ini');
define('ENEMIES', __DIR__ . '/Configuration/enemies.ini');
$setting = (new Ini\Valid(SETTING, new Ini\Typed(SETTING)))->read();
$enemies = new Ini\Valid(ENEMIES, new Ini\Typed(ENEMIES));
$http = new GuzzleHttp\Client([
    'base_uri' => $setting['url'],
    'allow_redirects' => true,
    'cookies' => new GuzzleHttp\Cookie\FileCookieJar($setting['cookie']),
]);
$entrance = new Bot\HttpEntrance($http);
$knight = $entrance->enter($setting['username'], $setting['password']);
//TODO