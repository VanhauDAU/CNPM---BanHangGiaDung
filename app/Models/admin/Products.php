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
        ->select('sanpham.*','danhmucsanpham.ten_danh_muc')
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
                $query->orWhere('maSP','like','%'.$keyword.'%');
                $query->orWhere('ten_san_pham','like','%'.$keyword.'%');
                $query->orWhere('maNSX','like','%'.$keyword.'%');
                $query->orWhere('id_danh_muc','like','%'.$keyword.'%');
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
        INNER JOIN danhmucsanpham ON danhmucsanpham.id_danh_muc = '.$this->table.'.id_danh_muc 
        INNER JOIN nhasanxuat ON nhasanxuat.maNSX = '.$this->table.'.maNSX 
        WHERE maSP = ? 
        ORDER BY '.$this->table.'.created_at DESC',[$id]);
    }
    public function addProduct($data){
        // $data['password'] = Hash::make($data['password']);
        $timestamp = now();
        $data[] = $timestamp;
        // dd($data); 
        DB::insert('INSERT INTO sanpham(maNSX, id_danh_muc, ten_san_pham, don_gia_goc,don_gia, trong_luong, mo_ta, so_luong_ton,anh,sp_noi_bat, created_at) values (?,?,?,?,?,?,?,?,?,?,?)', 
        $data);
    }
    public function addNSX($data){
        $timestamp = now();
        $data[] = $timestamp;
        DB::insert('INSERT INTO nhasanxuat(ten_NSX, dia_chi, email, so_dien_thoai, created_at) values (?,?,?,?,?)', $data);
    }
    public function addDM($data){
        $timestamp = now();
        $data[] = $timestamp;
        DB::insert('INSERT INTO danhmucsanpham(ten_danh_muc, icon, created_at) values (?,?,?)', $data);
    }
    public function deleteUser($id){
        return DB::delete("DELETE FROM $this->table WHERE maSP = ? ", [$id]);
    }
    public function updateProduct($data, $id){
        $data[] = now();
        $data[] = $id;
        return DB::update('UPDATE '.$this->table.' SET maNSX = ?, id_danh_muc = ?, anh = ?, ten_san_pham = ?, don_gia_goc = ?,don_gia = ?,trong_luong= ?, mo_ta = ?, so_luong_ton = ?, sp_noi_bat = ?, updated_at = ? WHERE maSP = ?', $data);
    }
}
