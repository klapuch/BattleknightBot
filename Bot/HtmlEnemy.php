<?php
declare(strict_types = 1);
namespace Battleknight\Bot;

use GuzzleHttp;

final class HtmlEnemy implements Enemy {
    private $id;
    private $http;

    public function __construct(int $id, GuzzleHttp\ClientInterface $http) {
        $this->id = $id;
        $this->http = $http;
    }

    public function id(): int {
        return $this->id;
    }

    public function name(): string {
        $response = $this->http->request(
            'GET',
            sprintf('common/profile/%d/', $this->id())
        );
        $dom = new \DOMDocument();
        @$dom->loadHTML((string)$response->getBody());
        $titleWithName = $dom->getElementById('profileImage')->nodeValue;
        return explode(' ', $titleWithName, 2)[1];
    }
}