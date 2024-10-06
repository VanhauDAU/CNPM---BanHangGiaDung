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
    public function getAllDanhMucSp1(){
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
    public function getAllProductCM($id){
        $groups = DB::table('sanpham')
        ->where('id_chuyen_muc','=',$id)
        ->where('trang_thai',1)
        ->count();
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
        ->where('trang_thai',1)
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
            ->distinct()
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table7 . '.id_danh_muc')
            ->where($this->table7. '.maNSX', $id)
            ->get(['danhmucsanpham.id_danh_muc', 'danhmucsanpham.ten_danh_muc']);
        // dd($groups);
        return $groups;
    }
    public function getDanhMuc2($id) {
        $groups = DB::table($this->table7)
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table7 . '.id_danh_muc')
            ->where($this->table7. '.maNSX', $id)
            ->count();
        return $groups;
    }
    public function getChuyenMuc1($id) {
        $groups = DB::table($this->table5)
            ->select('chitietdanhmucsp.*', 'danhmucsanpham.*', 'chitietdanhmucsp.slug as slugCm')
            ->join($this->table2, $this->table2 . '.id_danh_muc', '=', $this->table5 . '.id_danh_muc')
            ->where($this->table5 . '.id_danh_muc', $id)
            ->get();
        return $groups; // Kiểm tra dữ liệu ở đây
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
    public function getChuyenMucCountByNSXAndDanhMuc($maNSX, $idDanhMuc){
        $groups= DB::table('nsx_danhmuc')
        ->join('chitietdanhmucsp', 'chitietdanhmucsp.id_chuyen_muc','=','nsx_danhmuc.id_chuyen_muc')
        ->where('maNSX', $maNSX)
        ->where('nsx_danhmuc.id_danh_muc', $idDanhMuc)
        ->count();
        return $groups;
    }
    public function CountDanhMuc(){
        $groups = DB::table('danhmucsanpham')
        ->count();
        return $groups;
    }
    public function CountSanPham(){
        $groups = DB::table('sanpham')
        ->count();
        return $groups;
    }
    
}
