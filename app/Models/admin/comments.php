<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class comments extends Model
{
    protected $table ='binhluansp';
    use HasFactory;
    protected $fillable =['user_id', 'maSP','noi_dung','ho_ten_KHVL','so_dien_thoai_KHVL','email_KHVL','gioi_tinh_KHVL','trang_thai','provider','parent_id'];
    public function users(){
        return $this->belongsTo(Users::class);
    }
    public function products(){
        return $this->belongsTo(products::class);
    }
    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' INNER JOIN chucvu ON '.$this->table.'.maCV = chucvu.maCV WHERE username = ? ORDER BY created_at DESC',[$id]);
    }
    public function replies()
    {
        return $this->hasMany(comments::class, 'parent_id');
    }
}
