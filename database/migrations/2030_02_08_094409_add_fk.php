<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFk extends Migration
{
    public function up()
    {
        // FK users -> apartements 1:N
        Schema::table('apartments', function (Blueprint $table) {
            $table -> bigInteger('user_id') -> unsigned() -> index();
            $table -> foreign('user_id', 'user_apartment') -> references('id') -> on('users');
        });

        // FK apartements -> info_apartement 1:1
        Schema::table('apartments_info', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id', 'apartment_info_id') -> references('id') -> on('apartments');
        });

        // FK apartement -> messages 1:N
        Schema::table('messages', function (Blueprint $table) {
            $table -> bigInteger('apartment_id') -> unsigned() -> index();
            $table -> foreign('apartment_id', 'apartment_message') -> references('id') -> on('apartments');
        });

        // FK ad -> apartment N:N
        Schema::table('ad_apartment', function (Blueprint $table) {
            
            $table  -> bigInteger('apartment_id') 
                    -> unsigned() 
                    -> index();

            $table  -> foreign('apartment_id', 'apartment_ad')
                    -> references('id')
                    -> on('apartments');

            $table  -> bigInteger('ad_id') 
                    -> unsigned() 
                    -> index();

            $table  -> foreign('ad_id', 'ad_apartment')
                    -> references('id')
                    -> on('ads');
        });

    }

    public function down()
    {
        // FK users -> apartements 1:N
        Schema::table('users', function (Blueprint $table) {
            $table -> dropForeign('user_apartment');
            $table -> dropColumn('apartment_id');
        });

        // FK apartements -> info_apartement 1:1
        Schema::table('apartments_info', function (Blueprint $table) {
            $table -> dropForeign('apartment_info_id');
            $table -> dropColumn('apartment_id');
        });

        // FK apartement -> messages 1:N
        Schema::table('apartments', function (Blueprint $table) {
            $table -> dropForeign('apartment_message');
            $table -> dropColumn('message_id');
        });

        // FK apartements -> ad N:N
        Schema::table('ad_apartment', function (Blueprint $table) {
            $table -> dropForeign('apartment_ad');
            $table -> dropColumn('apartment_id');

            $table -> dropForeign('ad_apartment');
            $table -> dropColumn('ad_id');
        });

    }


}
