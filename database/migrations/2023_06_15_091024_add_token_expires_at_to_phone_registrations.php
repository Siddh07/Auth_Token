

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTokenExpiryToPhoneRegistration extends Migration
{
    public function up()
    {
        Schema::table('phone_registrations', function (Blueprint $table) {
            $table->timestamp('token_expires_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('phone_registrations', function (Blueprint $table) {
            $table->dropColumn('token_expires_at');
        });
    }
}
