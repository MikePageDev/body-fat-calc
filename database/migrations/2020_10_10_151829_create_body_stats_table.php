<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->float('wight');
            $table->float('fat_percent');
            $table->float('fat_lb');
            $table->float('muscle_percent');
            $table->float('muscle_lb');
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
        Schema::dropIfExists('body_stats');
    }
}
