<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $table = 'giohang';

    protected $fillable = [
        'user_id',
        'maSP',
        'so_luong',
    ];
}
