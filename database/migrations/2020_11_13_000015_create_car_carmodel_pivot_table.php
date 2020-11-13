<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCarmodelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('car_carmodel', function (Blueprint $table) {
            $table->unsignedInteger('carmodel_id');
            $table->foreign('carmodel_id', 'carmodel_id_fk_2578973')->references('id')->on('carmodels')->onDelete('cascade');
            $table->unsignedInteger('car_id');
            $table->foreign('car_id', 'car_id_fk_2578973')->references('id')->on('cars')->onDelete('cascade');
        });
    }
}
