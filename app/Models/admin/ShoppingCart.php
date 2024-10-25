<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Brands;
use App\Models\clients\Products;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $table = 'giohang';

    protected $fillable = [
        'user_id',
        'maSP',
        'qty',
        'price',
    ];

    public function products(){
        return $this->belongsTo(Products::class, 'maSP', 'maSP');
    }   
}
