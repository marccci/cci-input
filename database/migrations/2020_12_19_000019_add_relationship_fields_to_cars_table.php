<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarsTable extends Migration
{
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('manufacturer_id', 'manufacturer_fk_2484924')->references('id')->on('manufacturers');
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id', 'creator_fk_2586859')->references('id')->on('users');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_2595216')->references('id')->on('users');
        });
    }
}
