<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

use GuzzleHttp;

final class HttpEntrance implements Entrance {
    private $http;

    public function __construct(GuzzleHttp\ClientInterface $http) {
        $this->http = $http;
    }

    public function enter(string $username, string $password): Knight {
        $response = $this->http->request(
            'GET',
            sprintf('main/login/%s/%s', $username, md5($password))
        );
        if(stripos((string)$response->getBody(), $username) === false)
            throw new \UnexpectedValueException('Wrong server or credentials');
        $dom = new \DOMDocument();
        @$dom->loadHTML((string)$response->getBody());
        return new HtmlKnight($dom, $username, $this->http);
    }
}