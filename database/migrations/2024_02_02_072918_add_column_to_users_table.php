<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nama_belakang')->after('name')->nullable(true);
            $table->string('nomor_telepon')->after('email')->nullable(true);
            $table->text('alamat')->after('nomor_telepon')->nullable(true);
            $table->string('tanggal_lahir')->after('alamat')->nullable(true);
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan'])->after('tanggal_lahir')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
