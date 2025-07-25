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
            $table->integer('diem_so')->nullable()->after('dung_tien_do');
            $table->text('loi_nhan')->nullable()->after('diem_so');
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
            if (Schema::hasColumn('phieu_yeu_cau', 'diem_so')) {
                $table->dropColumn('diem_so');
            }
            if (Schema::hasColumn('phieu_yeu_cau', 'loi_nhan')) {
                $table->dropColumn('loi_nhan');
            }
            if (Schema::hasColumn('phieu_yeu_cau', 'diem_tien_do')) {
                $table->dropColumn('diem_tien_do');
            }
            if (Schema::hasColumn('phieu_yeu_cau', 'nhan_xet_tien_do')) {
                $table->dropColumn('nhan_xet_tien_do');
            }
        });
    }
};
