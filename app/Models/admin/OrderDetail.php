<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'chitietdonhang';
    public function Order(){
        return $this->belongsTo(Orders::class, 'id_don_hang', 'id');
    }
    public function Product(){
        return $this->belongsTo(Products::class, 'maSP', 'maSP');
    }
}
