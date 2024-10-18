<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'danhmucsanpham';
    protected $primaryKey = 'id_danh_muc';
    public function products()
    {
        return $this->hasMany(Products::class, 'id_danh_muc');
    }
}
