<?php

namespace striebwj\HorizonStats\Models;

use Illuminate\Database\Eloquent\Model;

class HorizonJobStat extends Model
{
    public const DB_NAME = 'name';
    public const DB_THROUGHPUT = 'throughput';
    public const DB_RUNTIME = 'runtime';

    public function __construct()
    {
        parent::__construct();

        $this->setTable(config('horizon-stats.table_name').'_jobs');
    }

    protected $fillable = [
        self::DB_NAME,
        self::DB_THROUGHPUT,
        self::DB_RUNTIME,
    ];
}
