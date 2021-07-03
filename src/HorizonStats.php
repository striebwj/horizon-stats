<?php

namespace striebwj\HorizonStats;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use Laravel\Horizon\Repositories\RedisMetricsRepository;
use striebwj\HorizonStats\Models\HorizonJobStat;
use striebwj\HorizonStats\Models\HorizonStat;

class HorizonStats
{
    /**
     * @var Application|mixed
     */
    private $horizonMetrics;

    /**
     * HorizonStats constructor.
     */
    public function __construct()
    {
        $this->horizonMetrics = app(RedisMetricsRepository::class);
    }


    /**
     * Store the snapshot data.
     *
     * @return void
     */
    public function storeSnapshotData(): void
    {
        $this->storeJobStats();
        $this->storeOverallStats();
    }

    /**
     * Store the overall stats since the last snapshot.
     *
     * @return void
     */
    private function storeOverallStats(): void
    {
        $model = new HorizonStat();

        $model->{HorizonStat::DB_JOBS_PER_MINUTE} = $this->horizonMetrics->jobsProcessedPerMinute();
        $model->{HorizonStat::DB_THROUGHPUT} = $this->horizonMetrics->throughput();

        $model->save();
    }

    /**
     * Store stats for each job since last snapshot.
     *
     * @return void
     */
    private function storeJobStats(): void
    {
        collect($this->horizonMetrics->measuredJobs())->each(function ($job) {
            $model = new HorizonJobStat();
            $model->{HorizonJobStat::DB_NAME} = $job;
            $model->{HorizonJobStat::DB_THROUGHPUT} = $this->horizonMetrics->throughputForJob($job);
            $model->{HorizonJobStat::DB_RUNTIME} = $this->horizonMetrics->runtimeForJob($job);
            $model->save();
        });
    }

}

