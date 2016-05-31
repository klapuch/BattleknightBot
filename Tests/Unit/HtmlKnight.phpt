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

final class HtmlKnight extends TestCase\Mockery {
    private $dom;

    public function setUp() {
        parent::setUp();
        $this->dom = new \DOMDocument();
        @$this->dom->loadHTMLFile(__DIR__ . '/../fight.html');
    }
    
    public function testLife() {
        Assert::same(
            75,
            (new Bot\HtmlKnight($this->dom, 'foo', new GuzzleHttp\Client))->life()
        );
    }
    
    public function testSilvers() {
        Assert::same(
            57,
            (new Bot\HtmlKnight($this->dom, 'foo', new GuzzleHttp\Client))->silvers()
        );
    }

    public function testName() {
        Assert::same(
            'foo',
            (new Bot\HtmlKnight($this->dom, 'foo', new GuzzleHttp\Client))->name()
        );
    }

    public function testExperiences() {
        Assert::equal(
            new Bot\HtmlExperiences($this->dom),
            (new Bot\HtmlKnight($this->dom, 'foo', new GuzzleHttp\Client))->experiences()
        );
    }

    public function testAttacking() {
        /** @var $http GuzzleHttp\ClientInterface */
        $http = $this->mockery('GuzzleHttp\ClientInterface');
        $response = $this->mockery('GuzzleHttp\ResponseInterface');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn('<html></html>');
        $http->shouldReceive('request')
            ->with('GET', 'duel/duel/?enemyID=123')
            ->once()
            ->andReturn($response);
        (new Bot\HtmlKnight($this->dom, 'foo', $http))->attack(
            new Bot\ConstantEnemy(123, 'someone')
        );
        Assert::true(true);
    }
}


(new HtmlKnight())->run();
