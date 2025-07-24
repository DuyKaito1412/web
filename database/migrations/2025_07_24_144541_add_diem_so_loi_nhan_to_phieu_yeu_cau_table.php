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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phieu_yeu_cau', function (Blueprint $table) {
            $table->dropColumn(['diem_so', 'loi_nhan']);
        });
    }
};
