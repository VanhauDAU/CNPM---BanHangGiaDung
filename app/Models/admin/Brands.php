<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table ='nhasanxuat';
    protected $primaryKey = 'maNSX';
    protected $fillable =['ten_NSX','dia_chi','so_dien_thoai','email','logo','slug','website'];
    public function products()
    {
        return $this->hasMany(Products::class, 'maNSX');
    }
}
