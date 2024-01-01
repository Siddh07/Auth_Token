<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('phone_registrations', function (Blueprint $table) {
            $table->dropColumn('verification_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('phone_registrations', function (Blueprint $table) {
           
        });
    }
};
