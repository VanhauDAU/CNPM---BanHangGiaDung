<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table ='binhluansp';
    use HasFactory;
    protected $fillable =['user_id', 'maSP','noi_dung','trang_thai'];
    public function users(){
        return $this->belongsTo(Users::class);
    }
    public function products(){
        return $this->belongsTo(products::class);
    }
}
