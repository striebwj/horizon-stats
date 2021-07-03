<?php

namespace striebwj\HorizonStats\Tests;

use striebwj\HorizonStats\ServiceProvider;
use Orchestra\Testbench\TestCase;

class HorizonStatsTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    public function testExample()
    {
        // TODO: Remove
        $this->assertEquals(1, 1);
    }
}
