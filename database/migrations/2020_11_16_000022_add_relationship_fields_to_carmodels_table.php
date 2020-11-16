<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarmodelsTable extends Migration
{
    public function up()
    {
        Schema::table('carmodels', function (Blueprint $table) {
            $table->unsignedInteger('manufacturer_id')->nullable();
            $table->foreign('manufacturer_id', 'manufacturer_fk_2578972')->references('id')->on('manufacturers');
            $table->unsignedInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_2587509')->references('id')->on('teams');
            $table->unsignedInteger('creator_id');
            $table->foreign('creator_id', 'creator_fk_2595217')->references('id')->on('users');
            $table->unsignedInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_2595218')->references('id')->on('users');
        });
    }
}
