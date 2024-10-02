<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    use HasFactory;
    protected $table = 'chucvu';
    protected $table2 = 'danhmucsanpham';
    protected $table3 = 'nhasanxuat';
    protected $table4 = 'sanpham';
    protected $table5 = 'chitietdanhmucsp';
    protected $table6 = 'baiviet';
    protected $table7 = 'nsx_danhmuc';
    public function getAll(){
        $groups = DB::table($this->table)
        ->orderBy('ten_chuc_vu','ASC')
        ->get();
        return $groups;
    }
    public function getAllNSX(){
        $groups = DB::table($this->table3)
        ->orderBy('created_at','DESC')
        ->get();
        return $groups;
    }
    public function getAllDanhMucSp(){
        $groups = DB::table($this->table2)
        ->orderBy('id_danh_muc','ASC')
        ->limit(10)
        ->get();
        return $groups;
    }
    public function getAllDanhMucSp2(){
        $groups = DB::table($this->table2)
        ->orderBy('created_at','DESC')
        ->get();
        return $groups;
    }
    
    public function getAllChuyenMucSp(){
        $groups = DB::table($this->table5)
        ->orderBy('id_chuyen_muc','ASC')
        ->get();
        return $groups;
    }
    public function getSanPhamNoiBat(){
        $groups = DB::table($this->table4)
        ->where('sp_noi_bat',1)
        ->orderBy('created_at', 'DESC')
        ->limit(12)
        ->get();
        return $groups;
    }
    public function getChuyenMuc($maNSX, $id_danh_muc) {
        $groups = DB::table($this->table7)
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table7 . '.id_danh_muc')
            ->join($this->table5, $this->table5 . '.id_chuyen_muc', '=', $this->table7 . '.id_chuyen_muc')
            ->where($this->table5 . '.id_danh_muc', $id_danh_muc)
            ->where($this->table7 . '.maNSX', $maNSX)
            ->get();
        return $groups;
    }
    public function getDanhMuc($id) {
        $groups = DB::table($this->table7)
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table7 . '.id_danh_muc')
            ->where($this->table7. '.maNSX', $id)
            ->get(['danhmucsanpham.id_danh_muc', 'danhmucsanpham.ten_danh_muc']);
        return $groups;
    }
    
    public function getChuyenMuc1($id) {
        $groups = DB::table($this->table5)
            ->select('chitietdanhmucsp.*', 'danhmucsanpham.*', 'chitietdanhmucsp.slug')
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table5 . '.id_danh_muc')
            ->where($this->table5 . '.id_danh_muc', $id)
            ->limit(8)
            ->get();
        
        return $groups; // Kiểm tra dữ liệu ở đây
    }
    
    public function getChuyenMuc2($id) {
        $groups = DB::table($this->table5)
            ->select('chitietdanhmucsp.*', 'danhmucsanpham.*', 'chitietdanhmucsp.slug')
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table5 . '.id_danh_muc')
            ->where($this->table5 . '.id_danh_muc', $id)
            ->skip(8)
            ->limit(8)
            ->get();
        return $groups;
    }  
    public function getChuyenMuc3($id) {
        $groups = DB::table($this->table5)
            ->select('chitietdanhmucsp.*', 'danhmucsanpham.*', 'chitietdanhmucsp.slug')
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table5 . '.id_danh_muc')
            ->where($this->table5 . '.id_danh_muc', $id)
            ->skip(16)
            ->limit(8)
            ->get();
        return $groups;
    }    
    public function getAllUserPost() {
        $groups = DB::table($this->table6)
            ->join('taikhoan', 'taikhoan.id', '=', $this->table6 . '.user_id')
            ->select($this->table6 . '.*','taikhoan.ho_ten') 
            ->orderBy($this->table6 . '.created_at', 'ASC')
            ->distinct('user_id')
            ->get();
    
        return $groups;
    }
    
}
