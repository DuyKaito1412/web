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
        Schema::table('phieu_yeu_cau', function (Blueprint $table) {
            $table->integer('diem_tien_do')->nullable()->after('loi_nhan');
            $table->text('nhan_xet_tien_do')->nullable()->after('diem_tien_do');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phieu_yeu_cau', function (Blueprint $table) {
            $table->dropColumn(['diem_tien_do', 'nhan_xet_tien_do']);
        });
    }
};
