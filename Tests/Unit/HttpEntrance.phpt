<?php
/**
 * @testCase
 * @phpVersion > 7.0.0
 */
namespace Klapuch\Unit;

use Tester,
    Tester\Assert;

use Battleknight\{
    TestCase, Bot
};
use GuzzleHttp;

require __DIR__ . '/../bootstrap.php';

final class HttpEntrance extends TestCase\Mockery {
    public function testEnteringWithCorrectCredentials() {
        /** @var $http GuzzleHttp\ClientInterface */
        $http = $this->mockery('GuzzleHttp\ClientInterface');
        $html = '<html><p>fOo is logged Uiiii</p></html>';
        $response = $this->mockery('GuzzleHttp\ResponseInterface');
        $response->shouldReceive('getBody')
            ->twice()
            ->andReturn($html);
        $http->shouldReceive('request')
            ->with('GET', 'main/login/foo/acbd18db4cc2f85cedef654fccc4a4d8')
            ->once()
            ->andReturn($response);
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        Assert::equal(
            new Bot\HtmlKnight($dom, 'foo', $http),
            (new Bot\HttpEntrance($http))->enter('foo', 'foo')
        );
    }

    /**
     * @throws \UnexpectedValueException Wrong server or credentials
     */
    public function testEnteringWithWrongCredentials() {
        /** @var $http GuzzleHttp\ClientInterface */
        $http = $this->mockery('GuzzleHttp\ClientInterface');
        $response = $this->mockery('GuzzleHttp\ResponseInterface');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn('<html><h1>Main Page, Please log in</h1></html>');
        $http->shouldReceive('request')
            ->with('GET', 'main/login/foo/acbd18db4cc2f85cedef654fccc4a4d8')
            ->once()
            ->andReturn($response);
        (new Bot\HttpEntrance($http))->enter('foo', 'foo');
    }
}


(new HttpEntrance())->run();
