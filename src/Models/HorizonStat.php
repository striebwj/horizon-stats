<?php

namespace striebwj\HorizonStats\Models;

use Illuminate\Database\Eloquent\Model;

class HorizonStat extends Model
{
    const DB_JOBS_PER_MINUTE = 'jobs_per_minute';
    const DB_THROUGHPUT = 'throughput';

    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('horizon-stats.table_name'));
    }

    protected $fillable = [
        self::DB_JOBS_PER_MINUTE, self::DB_THROUGHPUT
    ];


    // RELEATIONSHIPS

    /**
     * The jobs stats for this snapshot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jobStats()
    {
        return $this->hasMany(HorizonJobStat::class);
    }

    /**
     * The queue stats for this snapshot.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function queueStats()
    {
        return $this->hasMany(HorizonQueueStat::class);

    }

}
