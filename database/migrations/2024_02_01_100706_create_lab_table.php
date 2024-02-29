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
        Schema::create('lab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lab');
            $table->string('kapasitas')->default(0);
            $table->integer('jumlah_komputer')->default(0);
            $table->enum('status',['tersedia','tidak tersedia'])->default('tidak tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab');
    }
};
