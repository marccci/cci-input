<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToGaragesTable extends Migration
{
    public function up()
    {
        Schema::table('garages', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_2578922')->references('id')->on('users');
            $table->unsignedInteger('car_id');
            $table->foreign('car_id', 'car_fk_2586495')->references('id')->on('cars');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2587510')->references('id')->on('teams');
        });
    }
}
