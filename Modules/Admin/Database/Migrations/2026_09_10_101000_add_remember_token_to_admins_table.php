<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRememberTokenToAdminsTable extends Migration
{
    public function up()
    {
        if (! Schema::hasColumn('admins', 'remember_token')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->rememberToken()->after('avatar');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('admins', 'remember_token')) {
            Schema::table('admins', function (Blueprint $table) {
                $table->dropColumn('remember_token');
            });
        }
    }
}
