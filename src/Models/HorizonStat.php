<?php

namespace striebwj\HorizonStats\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HorizonStat extends Model
{
    public const DB_JOBS_PER_MINUTE = 'jobs_per_minute';
    public const DB_THROUGHPUT = 'throughput';

    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('horizon-stats.table_name'));
    }

    protected $fillable = [
        self::DB_JOBS_PER_MINUTE,
        self::DB_THROUGHPUT
    ];

    /**
     * The jobs stats for this snapshot.
     *
     * @return HasMany
     */
    public function jobStats(): HasMany
    {
        return $this->hasMany(HorizonJobStat::class);
    }

    /**
     * The queue stats for this snapshot.
     *
     * @return HasMany
     */
    public function queueStats(): HasMany
    {
        return $this->hasMany(HorizonQueueStat::class);

    }

}
