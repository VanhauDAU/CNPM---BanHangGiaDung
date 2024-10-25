<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
}
