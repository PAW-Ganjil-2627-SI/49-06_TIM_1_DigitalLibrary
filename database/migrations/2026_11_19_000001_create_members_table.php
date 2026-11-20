<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_number', 30)->unique();
            $table->string('card_number', 40)->unique();
            $table->string('name', 120);
            $table->string('email', 120)->nullable();
            $table->string('phone', 30)->nullable();
            $table->text('address')->nullable();
            $table->enum('membership_type', ['Siswa', 'Mahasiswa', 'Umum', 'Dosen']);
            $table->date('joined_at');
            $table->date('expires_at');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
