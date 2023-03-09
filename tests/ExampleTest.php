<?php

namespace Javaabu\PgoDbAPI\Tests;

use Illuminate\Support\Facades\App;
use Javaabu\PgoDbAPI\Facades\PgoDbAPI;

class ExampleTest extends TestCase
{
    /** @test */
    public function true_is_true()
    {
        $pgodb_api = App::make('pgodb-api');
        $res = $pgodb_api->criminalCase()->find('37a6/3f22022a');
        $this->assertIsArray($res);
        $this->assertTrue(true);
    }
}
