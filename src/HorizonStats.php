<?php

namespace striebwj\HorizonStats;

use Illuminate\Contracts\Foundation\Application;
use Laravel\Horizon\Repositories\RedisMetricsRepository;
use striebwj\HorizonStats\Models\HorizonJobStat;
use striebwj\HorizonStats\Models\HorizonQueueStat;
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
    public static function storeSnapshotData(): void
    {
        $self = new self();
        $stat = $self->storeOverallStats();

        $self->storeJobStats($stat);
        $self->storeQueueStats($stat);
    }

    /**
     * Store the overall stats since the last snapshot.
     *
     * @return HorizonStat
     */
    private function storeOverallStats(): HorizonStat
    {
        $model = new HorizonStat();

        $model->{HorizonStat::DB_JOBS_PER_MINUTE} = $this->horizonMetrics->jobsProcessedPerMinute();
        $model->{HorizonStat::DB_THROUGHPUT} = $this->horizonMetrics->throughput();
        $model->save();

        return $model;
    }

    /**
     * Store stats for each job since last snapshot.
     *
     * @param $stat
     * @return void
     */
    private function storeJobStats($stat): void
    {
        collect($this->horizonMetrics->measuredJobs())->each(function ($job) use ($stat) {
            $model = new HorizonJobStat();
            $model->{HorizonJobStat::DB_HORIZON_STAT_ID} = $stat->id;
            $model->{HorizonJobStat::DB_NAME} = $job;
            $model->{HorizonJobStat::DB_THROUGHPUT} = $this->horizonMetrics->throughputForJob($job);
            $model->{HorizonJobStat::DB_RUNTIME} = $this->horizonMetrics->runtimeForJob($job);
            $model->save();
        });
    }


    /**
     * Store stats for each queue since last snapshot.
     *
     * @param $stat
     * @return void
     */
    private function storeQueueStats($stat): void
    {
        collect($this->horizonMetrics->measuredQueues())->each(function ($queue) use ($stat) {
            $model = new HorizonQueueStat();
            $model->{HorizonQueueStat::DB_HORIZON_STAT_ID} = $stat->id;
            $model->{HorizonQueueStat::DB_NAME} = $queue;
            $model->{HorizonQueueStat::DB_THROUGHPUT} = $this->horizonMetrics->throughputForQueue($queue);
            $model->{HorizonQueueStat::DB_RUNTIME} = $this->horizonMetrics->runtimeForQueue($queue);
            $model->save();
        });
    }
}
