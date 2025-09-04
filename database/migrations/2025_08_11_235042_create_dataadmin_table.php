<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dataadmin', function (Blueprint $table) {
            $table->id('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
            $table->string('role')->default('admin');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dataadmin');
    }
};
