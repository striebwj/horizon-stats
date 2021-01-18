<?php

namespace striebwj\HorizonStats\Models;

use Illuminate\Database\Eloquent\Model;

class HorizonQueueStat extends Model
{

    const DB_NAME = 'name';
    const DB_THROUGHPUT = 'throughput';
    const DB_RUNTIME = 'runtime';

    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('horizon-stats.table_name') . '_queues');
    }

    protected $fillable = [
        self::DB_NAME, self::DB_THROUGHPUT, self::DB_RUNTIME,
    ];



}
