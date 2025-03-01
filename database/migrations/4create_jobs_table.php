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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hrd_id')->constrained('users')->onDelete('cascade'); // HRD sebagai pemilik job
            $table->string('posisi');
            $table->string('nama_perusahaan');
            $table->string('tempat_kerja');
            $table->enum('tipe_pekerjaan', ['full_time', 'part_time']);
            $table->decimal('gaji', 10, 2);
            $table->text('deskripsi_pekerjaan');
            $table->text('requirements');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
