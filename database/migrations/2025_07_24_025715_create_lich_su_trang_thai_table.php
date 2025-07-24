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
        Schema::create('lich_su_trang_thai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phieu_yeu_cau_id');
            $table->string('trang_thai');
            $table->timestamp('thoi_gian');
            $table->string('ghi_chu')->nullable();
            $table->timestamps();
            $table->foreign('phieu_yeu_cau_id')->references('id')->on('phieu_yeu_cau');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_trang_thai');
    }
};
