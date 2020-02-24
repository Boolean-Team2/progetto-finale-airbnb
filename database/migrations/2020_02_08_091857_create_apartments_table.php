<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->string('img')->nullable();
            $table->integer('rooms');
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('mq');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address');
            // $table->integer('views')->nullable();
            $table->boolean('visibility')->nullable();
            $table->boolean('sponsored')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartments');
    }
}
