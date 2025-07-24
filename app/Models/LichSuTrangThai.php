<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuTrangThai extends Model
{
    protected $table = 'lich_su_trang_thai';
    protected $fillable = [
        // Thêm các trường phù hợp với migration thực tế
    ];

    public function phieuYeuCau()
    {
        return $this->belongsTo(PhieuYeuCau::class, 'phieu_yeu_cau_id');
    }
}
