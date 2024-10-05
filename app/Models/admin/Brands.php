<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $table ='nhasanxuat';
    protected $fillable =['ten_NSX','dia_chi','so_dien_thoai','email','logo','slug','website'];
}
