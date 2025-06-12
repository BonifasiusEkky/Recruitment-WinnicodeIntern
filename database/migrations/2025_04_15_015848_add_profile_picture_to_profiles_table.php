<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfilePictureToProfilesTable extends Migration
{
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('alamat');
        });
    }

    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('profile_picture');
        });
    }
}