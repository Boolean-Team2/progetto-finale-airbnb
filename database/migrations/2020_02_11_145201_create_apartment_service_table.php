<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentServiceTable extends Migration
{
    public function up()
    {
        Schema::create('apartment_service', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('apartment_service');
    }
}
