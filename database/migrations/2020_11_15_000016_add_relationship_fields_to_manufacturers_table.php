<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToManufacturersTable extends Migration
{
    public function up()
    {
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->unsignedInteger('creator_id');
            $table->foreign('creator_id', 'creator_fk_2586857')->references('id')->on('users');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2587506')->references('id')->on('teams');
        });
    }
}
