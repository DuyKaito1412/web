<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    // Ánh xạ tên cột
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    protected $fillable = [
        'ho_ten', 'email', 'mat_khau', 'so_dien_thoai', 'vai_tro'
    ];

    protected $hidden = [
        'mat_khau'
    ];

    public function getAuthPassword()
    {
        return $this->mat_khau;
    }

    // Mutator để mã hóa mật khẩu
    public function setMatKhauAttribute($value)
    {
        $this->attributes['mat_khau'] = Hash::make($value);
    }

    // Các thuộc tính được cast
    protected function casts(): array
    {
        return [
            'ngay_tao' => 'datetime',
            'ngay_cap_nhat' => 'datetime',
            'trang_thai_hoat_dong' => 'integer'
        ];
    }

    public function getFilamentName(): string
    {
        if (!empty($this->ho_ten)) {
            return $this->ho_ten;
        }
        if (!empty($this->email)) {
            return $this->email;
        }
        return 'User';
    }

    public function getNameAttribute()
    {
        return $this->ho_ten ?? $this->email ?? 'User';
    }
}
