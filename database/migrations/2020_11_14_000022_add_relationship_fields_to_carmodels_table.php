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
        });
    }
}
