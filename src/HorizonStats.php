<?php

namespace striebwj\HorizonStats;

use Laravel\Horizon\Repositories\RedisMetricsRepository;
use striebwj\HorizonStats\Models\HorizonJobStat;
use striebwj\HorizonStats\Models\HorizonStat;

class HorizonStats
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $horizonMetrics;

    /**
     * HorizonStats constructor.
     */
    public function __construct()
    {
        $this->horizonMetrics = app(RedisMetricsRepository::class);
    }

    public function storeSnapshotData()
    {
        $snapshot = $this->storeJobStats();


    }


    /**
     * Store the overall stats since the last snapshot.
     *
     * @return HorizonStat $model
     */
    public function storeOverallStats()
    {
        $model = new HorizonStat();

        $model->{HorizonStat::DB_JOBS_PER_MINUTE} = $this->horizonMetrics->jobsProcessedPerMinute();
        $model->{HorizonStat::DB_THROUGHPUT} = $this->horizonMetrics->throughput();

        $model->save();

        return $model;
    }

    public function storeJobStats()
    {
        return collect($this->horizonMetrics->measuredJobs())->each(function ($job)  {
            $model = new HorizonJobStat();
            $model->{HorizonJobStat::DB_NAME} = $job;
            $model->{HorizonJobStat::DB_THROUGHPUT} = $this->horizonMetrics->throughputForJob($job);
            $model->{HorizonJobStat::DB_RUNTIME} = $this->horizonMetrics->runtimeForJob($job);
            $model->save();
        });
    }

}

