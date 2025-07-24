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
        Schema::create('phieu_yeu_cau', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // khách hàng
            $table->unsignedBigInteger('loai_su_co_id'); // loại dịch vụ/sự cố
            $table->string('mo_ta_su_co');
            $table->string('dia_chi');
            $table->string('trang_thai'); // trạng thái: đang gửi, đã tiếp nhận, đã giao kỹ thuật, hoàn thành
            $table->timestamp('thoi_gian_tiep_nhan')->nullable();
            $table->timestamp('thoi_gian_giao_ky_thuat')->nullable();
            $table->timestamp('thoi_gian_hoan_thanh')->nullable();
            $table->unsignedBigInteger('nhan_vien_truc_id')->nullable();
            $table->unsignedBigInteger('nhan_vien_ky_thuat_id')->nullable();
            $table->timestamps();
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('loai_su_co_id')->references('id')->on('loai_su_co');
            $table->foreign('nhan_vien_truc_id')->references('id')->on('users');
            $table->foreign('nhan_vien_ky_thuat_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieu_yeu_cau');
    }
};
