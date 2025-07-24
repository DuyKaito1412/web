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
            $table->boolean('dung_tien_do')->nullable()->after('thoi_gian_hoan_thanh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phieu_yeu_cau', function (Blueprint $table) {
            $table->dropColumn('dung_tien_do');
        });
    }
};
