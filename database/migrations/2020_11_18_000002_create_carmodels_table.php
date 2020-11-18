<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarmodelsTable extends Migration
{
    public function up()
    {
        Schema::create('carmodels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->date('first_year');
            $table->date('last_year');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
