<?php

namespace striebwj\HorizonStats\Tests;

use striebwj\HorizonStats\Facades\HorizonStats;
use striebwj\HorizonStats\ServiceProvider;
use Orchestra\Testbench\TestCase;

class HorizonStatsTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'horizon-stats' => HorizonStats::class,
        ];
    }

    public function testExample()
    {
        // TODO: Remove
        $this->assertEquals(1, 1);
    }
}
