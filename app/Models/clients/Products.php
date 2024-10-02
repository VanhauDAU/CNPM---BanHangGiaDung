<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Products extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    public function getAllProductsMAIN(){
        return DB::table($this->table)->select('sanpham.*')->get();
    }
    
    public function getAllProducts($filters = [],$keyword = null,$sortArr=null, $perPage = null){
        $products = DB::table($this->table)
        ->select('sanpham.*','nhasanxuat.*','danhmucsanpham.*','chitietdanhmucsp.*','sanpham.slug')
        ->join('nhasanxuat','sanpham.maNSX','=','nhasanxuat.maNSX')
        ->join('danhmucsanpham','sanpham.id_danh_muc','=','danhmucsanpham.id_danh_muc')
        ->join('chitietdanhmucsp','sanpham.id_chuyen_muc','=','chitietdanhmucsp.id_chuyen_muc');
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
        INNER JOIN chitietdanhmucsp ON chitietdanhmucsp.id_chuyen_muc = '.$this->table.'.id_chuyen_muc
        WHERE sanpham.slug = ? 
        ORDER BY '.$this->table.'.created_at DESC',[$id]);
    }
    public function getDetail2($id){
        return DB::select('SELECT * FROM '.$this->table.' 
        INNER JOIN danhmucsanpham ON danhmucsanpham.id_danh_muc = '.$this->table.'.id_danh_muc 
        INNER JOIN nhasanxuat ON nhasanxuat.maNSX = '.$this->table.'.maNSX 
        INNER JOIN chitietdanhmucsp ON chitietdanhmucsp.id_chuyen_muc = '.$this->table.'.id_chuyen_muc
        WHERE chitietdanhmucsp.id_chuyen_muc = ? 
        ORDER BY '.$this->table.'.created_at DESC',[$id]);
    }
    public function getAllNSX(){
        return DB::table('nhasanxuat')
        ->orderBy('ten_NSX','ASC')
        ->get();
    }
    public function getDetailDM_Nsx($id){
        return DB::select('SELECT DISTINCT nhasanxuat.maNSX,nhasanxuat.ten_NSX,danhmucsanpham.id_danh_muc,danhmucsanpham.ten_danh_muc FROM nsx_danhmuc
        INNER JOIN danhmucsanpham ON danhmucsanpham.id_danh_muc = nsx_danhmuc.id_danh_muc
        INNER JOIN nhasanxuat ON nhasanxuat.maNSX = nsx_danhmuc.maNSX
        WHERE nsx_danhmuc.id_danh_muc =?',[$id]);
    }
    public function getDetailDM_CM_Nsx($id,$id2){
        return DB::select('SELECT * FROM nsx_danhmuc
        INNER JOIN danhmucsanpham ON danhmucsanpham.id_danh_muc = nsx_danhmuc.id_danh_muc
        INNER JOIN chitietdanhmucsp ON chitietdanhmucsp.id_chuyen_muc = nsx_danhmuc.id_chuyen_muc
        WHERE nsx_danhmuc.id_danh_muc =? and nsx_danhmuc.id_chuyen_muc =?
        ',[$id,$id2]);
    }
    public function getDetail3($id){
        return DB::select('SELECT * FROM '.$this->table.' 
        INNER JOIN danhmucsanpham ON danhmucsanpham.id_danh_muc = '.$this->table.'.id_danh_muc 
        INNER JOIN nhasanxuat ON nhasanxuat.maNSX = '.$this->table.'.maNSX 
        INNER JOIN chitietdanhmucsp ON chitietdanhmucsp.id_chuyen_muc = '.$this->table.'.id_chuyen_muc
        WHERE chitietdanhmucsp.id_chuyen_muc = ? 
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
