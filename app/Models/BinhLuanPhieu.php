<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BinhLuanPhieu extends Model
{
    protected $table = 'binh_luan_phieu';
    protected $fillable = [
        'phieu_yeu_cau_id',
        'user_id',
        'diem_so',
        'loi_nhan',
    ];

    // Ví dụ quan hệ
    public function phieuYeuCau()
    {
        return $this->belongsTo(PhieuYeuCau::class, 'phieu_yeu_cau_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
