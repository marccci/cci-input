<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnginesTable extends Migration
{
    public function up()
    {
        Schema::create('engines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->float('bore', 15, 3);
            $table->float('stroke', 15, 2);
            $table->integer('cylinder_number');
            $table->string('block_config');
            $table->string('power_units');
            $table->integer('engine_power');
            $table->integer('engine_size');
            $table->string('engine_size_units');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
