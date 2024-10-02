<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'khuyenmai';

    protected $fillable = [
        'ten_khuyen_mai', 'loai_khuyen_mai', 'gia_tri', 'bat_dau', 'ket_thuc', 'trang_thai'
    ];

    public function sanPhams()
    {
        return $this->belongsToMany(Products::class, 'sanpham_khuyenmai', 'khuyen_mai_id', 'san_pham_id');
    }
}
