<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    use HasFactory;
    protected $table = 'sanpham_anh';
    public function product(){
        return $this->beLongsTo(Products::class,'product_id','maSP');
    }
}
