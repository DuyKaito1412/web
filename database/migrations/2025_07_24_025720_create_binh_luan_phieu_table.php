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
        Schema::create('binh_luan_phieu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phieu_yeu_cau_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('diem_so'); // 1-5
            $table->string('loi_nhan')->nullable();
            $table->timestamps();
            $table->foreign('phieu_yeu_cau_id')->references('id')->on('phieu_yeu_cau');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luan_phieu');
    }
};
