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
    Schema::create('application_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
        $table->enum('status', ['pending', 'accepted', 'rejected']);
        $table->text('catatan')->nullable(); // HRD bisa menambahkan catatan alasan diterima/ditolak
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_histories');
    }
};
