<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoaiSuCo extends Model
{
    protected $table = 'loai_su_co';
    protected $fillable = [
        'ten_loai',
        'mo_ta'
    ];
}
