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
        // $products = DB::select('SELECT * FROM '.$this->table.' ORDER BY username DESC');
        // DB::enableQueryLog();

        $products = DB::table($this->table)
        ->select('sanpham.*','nhasanxuat.*','danhmucsanpham.*')
        ->join('nhasanxuat','sanpham.maNSX','=','nhasanxuat.maNSX')
        ->join('danhmucsanpham','sanpham.nhomSP','=','danhmucsanpham.nhomSP');
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
        // $sql = DB::getQueryLog();
        // dd($sql);
        // dd($products);
        return $products;
    }
}
