<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturersTable extends Migration
{
    public function up()
    {
        Schema::create('manufacturers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('country');
            $table->string('country_code')->nullable();
            $table->integer('first_year');
            $table->integer('last_year');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
