<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToManufacturersTable extends Migration
{
    public function up()
    {
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id', 'creator_fk_2586857')->references('id')->on('users');
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id', 'owner_fk_2615073')->references('id')->on('users');
        });
    }
}
