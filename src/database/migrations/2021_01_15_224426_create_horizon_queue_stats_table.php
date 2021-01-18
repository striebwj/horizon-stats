<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorizonQueueStatsTable extends Migration
{
    private $tableName;

    public function __construct()
    {
        $this->tableName = config('horizon-stats.table_name') . '_queues';
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('horizon_stats_id');
            $table->mediumText('name');
            $table->float('throughput')->default(0);
            $table->float('runtime')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
