<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'khuyenmai';
    // protected $fillable = [
    //     'ten_khuyen_mai', 'loai_khuyen_mai', 'gia_tri_khuyen_mai', 'ngay_bat_dau', 'ngay_ket_thuc', 'trang_thai'
    // ];

    protected $attributes = [
        'loai_khuyen_mai'=>0,
        'trang_thai'=>0
    ];
}
