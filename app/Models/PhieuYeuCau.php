<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuYeuCau extends Model
{
    protected $table = 'phieu_yeu_cau';
    protected $fillable = [
        'user_id',
        'loai_su_co_id',
        'mo_ta_su_co',
        'dia_chi',
        'trang_thai',
        'thoi_gian_tiep_nhan',
        'thoi_gian_giao_ky_thuat',
        'thoi_gian_hoan_thanh',
        'nhan_vien_truc_id',
        'nhan_vien_ky_thuat_id',
        'diem_so',
        'loi_nhan',
    ];

    // Ví dụ quan hệ
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loaiSuCo()
    {
        return $this->belongsTo(\App\Models\LoaiSuCo::class, 'loai_su_co_id');
    }

    public function binhLuanPhieu()
    {
        return $this->hasMany(\App\Models\BinhLuanPhieu::class, 'phieu_yeu_cau_id');
    }
}
