<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdTable extends Migration
{
    public function up()
    {
        Schema::create('ad', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('24h');
            $table->boolean('72h');
            $table->boolean('144h');
            $table->time('duration_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ad');
    }
}
