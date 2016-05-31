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

final class HtmlEnemy extends TestCase\Mockery {
    public function testEnteringWithCorrectCredentials() {
        /** @var $http GuzzleHttp\ClientInterface */
        $http = $this->mockery('GuzzleHttp\ClientInterface');
        $response = $this->mockery('GuzzleHttp\ResponseInterface');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn('<div id="profileImage" class="charMaleNeutral"><h2>Lord FooBar</h2></div>');
        $http->shouldReceive('request')
            ->with('GET', 'common/profile/123/')
            ->once()
            ->andReturn($response);
        Assert::same('FooBar', (new Bot\HtmlEnemy(123, $http))->name());
    }

    public function testId() {
        /** @var $http GuzzleHttp\ClientInterface */
        $http = $this->mockery('GuzzleHttp\ClientInterface');
        Assert::same(123, (new Bot\HtmlEnemy(123, $http))->id());
    }
}


(new HtmlEnemy())->run();
