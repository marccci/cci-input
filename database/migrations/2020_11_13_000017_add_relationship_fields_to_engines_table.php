<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEnginesTable extends Migration
{
    public function up()
    {
        Schema::table('engines', function (Blueprint $table) {
            $table->unsignedInteger('manufacturer_id');
            $table->foreign('manufacturer_id', 'manufacturer_fk_2484909')->references('id')->on('manufacturers');
            $table->unsignedInteger('creator_id');
            $table->foreign('creator_id', 'creator_fk_2586858')->references('id')->on('users');
        });
    }
}
