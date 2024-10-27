<?php

namespace App\Models\admin;

use App\Models\clients\Ward;
use App\Models\clients\District;
use App\Models\clients\Province;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;
    protected $table ='donhang';
    public function getAllorders(){
        $orders = DB::select('SELECT * FROM donhang');
        return $orders;
    }
    public function OrderDetail(){
        return $this->hasMany(OrderDetail::class, 'id_don_hang', 'id');
    }
    public function User(){
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
    public function Province(){
        return $this->belongsTo(Province::class,'province_id','province_id');
    }
    public function District(){
        return $this->belongsTo(District::class,'district_id','district_id');
    }
    public function Wards(){
        return $this->belongsTo(Ward::class,'wards_id','wards_id');
    }
}
