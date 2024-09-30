<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Products extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    public function getAllProducts($filters = [],$keyword = null,$sortArr=null, $perPage = null){
        $products = DB::table($this->table)
        ->select('sanpham.*','nhasanxuat.*','danhmucsanpham.*')
        ->join('nhasanxuat','sanpham.maNSX','=','nhasanxuat.maNSX')
        ->join('danhmucsanpham','sanpham.id_danh_muc','=','danhmucsanpham.id_danh_muc');
        $orderBy = 'sanpham.created_at';
        $orderType='desc';
        if(!empty($sortArr) & is_array($sortArr)){
            if(!empty($sortArr['sortBy']) & !empty($sortArr['sortType'])){
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }
        $products = $products->orderBy($orderBy,$orderType);
        if(!empty($filters)){
            $products = $products->where($filters);
        }
        if(!empty($keyword)){
            $products = $products->where(function($query) use ($keyword){
                $query->orWhere('ten_san_pham','like','%'.$keyword.'%');
                $query->orWhere('mo_ta','like','%'.$keyword.'%');
                $query->orWhere('maSP','like','%'.$keyword.'%');
            });
        }
        if(!empty($perPage)){
            $products = $products->paginate($perPage)->appends(request()->query());
        }else{
            $products = $products->get();
        }
        return $products;
    }
    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' 
        INNER JOIN danhmucsanpham ON danhmucsanpham.id_danh_muc = '.$this->table.'.id_danh_muc 
        INNER JOIN nhasanxuat ON nhasanxuat.maNSX = '.$this->table.'.maNSX 
        WHERE maSP = ? 
        ORDER BY '.$this->table.'.created_at DESC',[$id]);
    }
    // tính số sao của sản phẩm
    // public function ratings()
    // {
    //     return $this->hasMany(Rating::class);
    // }

    // public function averageRating()
    // {
    //     return $this->ratings()->avg('rating');
    // }
}
