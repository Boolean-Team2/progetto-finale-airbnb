<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('wifi');
            $table->boolean('parking');
            $table->boolean('pool');
            $table->boolean('reception');
            $table->boolean('sauna');
            $table->boolean('sea_view');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartements_info');
    }
}
