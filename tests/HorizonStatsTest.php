<?php

namespace striebwj\HorizonStats\Tests;

use Illuminate\Support\Facades\Queue;
use Laravel\Horizon\Contracts\MetricsRepository;
use Orchestra\Testbench\TestCase;

class HorizonStatsTest extends TestCase
{
    public function testExample()
    {
        $this->markTestSkipped('TODO');

        Queue::push(new Jobs\BasicJob);
        Queue::push(new Jobs\BasicJob);

        $this->work();
        $this->work();

        $this->assertSame(2, resolve(MetricsRepository::class)->throughput());

        // TODO: Remove
        $this->assertEquals(1, 1);
    }
}
