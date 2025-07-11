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
        Schema::table('jobs', function (Blueprint $table) {
            $table->date('expired_at')->nullable()->after('requirements'); 
            $table->boolean('status')->default(true)->after('expired_at');
        });
    }
    
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['expired_at', 'status']);
        });
    }
    
};
