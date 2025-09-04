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
    Schema::create('datasiswa', function (Blueprint $table) {
        $table->id('idsiswa');
        $table->string('nama')->nullable();
        $table->integer('tb')->nullable();
        $table->integer('bb')->nullable();
        $table->unsignedBigInteger('id');
        $table->foreign('id')->references('id')->on('dataadmin')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('datasiswa');
}

};
