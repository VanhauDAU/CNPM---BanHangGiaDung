<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class products extends Model
{
    use HasFactory;
    protected $table ='sanpham';
    protected $tableDM ='danhmucsanpham';

    public function getAllProducts($filters = [],$keyword = null,$sortArr=null, $perPage = null){
        $products = DB::table($this->table)
        ->select('sanpham.*','danhmucsanpham.ten_nhom')
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
                $query->orWhere('maSP','like','%'.$keyword.'%');
                $query->orWhere('ten_san_pham','like','%'.$keyword.'%');
                $query->orWhere('maNSX','like','%'.$keyword.'%');
                $query->orWhere('nhomSP','like','%'.$keyword.'%');
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
    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' 
        INNER JOIN danhmucsanpham ON danhmucsanpham.nhomSP = '.$this->table.'.nhomSP 
        INNER JOIN nhasanxuat ON nhasanxuat.maNSX = '.$this->table.'.maNSX 
        WHERE maSP = ? 
        ORDER BY '.$this->table.'.created_at DESC',[$id]);
    }
    public function addProduct($data){
        // $data['password'] = Hash::make($data['password']);
        $timestamp = now();
        $data[] = $timestamp;
        // dd($data); 
        DB::insert('INSERT INTO sanpham(maSP, maNSX, nhomSP, anh, ten_san_pham, don_gia, trong_luong, mo_ta, so_luong_ton, created_at) values (?,?,?,?,?,?,?,?,?,?)', 
        $data);
    }
    public function addNSX($data){
        $timestamp = now();
        $data[] = $timestamp;
        DB::insert('INSERT INTO nhasanxuat(maNSX, ten_NSX, dia_chi, email, so_dien_thoai, created_at) values (?,?,?,?,?,?)', $data);

    }
    
}
