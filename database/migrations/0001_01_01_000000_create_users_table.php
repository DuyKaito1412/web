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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten')->nullable();
            $table->string('email')->unique();
            $table->string('so_dien_thoai')->nullable();
            $table->string('mat_khau');
            $table->string('vai_tro')->nullable();
            $table->string('ma_khach_hang')->nullable();
            $table->string('dia_chi')->nullable();
            $table->integer('trang_thai_hoat_dong')->default(1);
            $table->string('email_xac_thuc_tai')->nullable();
            $table->string('token_ghi_nho')->nullable();

            // Thêm các cột created_at và updated_at với tên mới
            $table->timestamp('ngay_tao')->nullable();
            $table->timestamp('ngay_cap_nhat')->nullable();

            $table->rememberToken();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
