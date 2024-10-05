<?php
use App\Models\admin\Groups;
use App\Models\admin;
function getAllGroups(){
    $group = new Groups;
    return $group->getAll();
}
function getAllUserPost(){
    $group = new Groups;
    return $group->getAllUserPost();
}
function getAllProductCM($id){
    $group = new Groups;
    return $group->getAllProductCM($id);
}

function getAllNSX(){
    $group = new Groups;
    return $group->getAllNSX();
}
function getAllDanhMucSp(){
    $group = new Groups;
    return $group->getAllDanhMucSp();
}
function CountDanhMuc(){
    $group = new Groups;
    return $group->CountDanhMuc();
}
function CountSanPham(){
    $group = new Groups;
    return $group->CountSanPham();
}
function getAllDanhMucSp2(){
    $group = new Groups;
    return $group->getAllDanhMucSp2();
}
function getAllChuyenMucSp(){
    $group = new Groups;
    return $group->getAllChuyenMucSp();
}
function CountChuyenMucNSX($id,$maNSX){
    return DB::table('nsx_danhmuc')
    ->where('id_danh_muc',$id)
    ->where('maNSX',$maNSX)
    ->count();
}
function CountSanPhamNSX($maNSX){
    return DB::table('sanpham')
    ->where('maNSX',$maNSX)
    ->count();
}
function CountSanPhamCM($maNSX,$idDm){
    return DB::table('sanpham')
    ->where('maNSX',$maNSX)
    ->where('id_chuyen_muc',$idDm)
    ->count();
}
function isAdminActive($username){
    $count = admin::where('username', $username)->where('loai_tai_khoan',1)->count();
    if($count > 0){
        return true;
    }else{
        return false;
    }
}
function sanphamnoibat(){
    $groups = new Groups;
    return $groups->getSanPhamNoiBat();
}
function getDanhMucSP($id){
    $groups = new Groups();
    return $groups->getDanhMuc($id);
}
function getDanhMucSP2($id){
    $groups = new Groups();
    return $groups->getDanhMuc2($id);
}
function getChuyenMucSP($maNSX, $id_danh_muc){
    $groups = new Groups();
    return $groups->getChuyenMuc($maNSX, $id_danh_muc);
}
function getChuyenMuc1($id){
    $groups = new Groups();
    return $groups->getChuyenMuc1($id);
}
function getChuyenMucCountByNSXAndDanhMuc($maNSX, $idDanhMuc)
{
    $groups = new Groups();
    return $groups->getChuyenMucCountByNSXAndDanhMuc($maNSX, $idDanhMuc);
}
function CountCmt($id) {
    $countBinhluansp = DB::table('binhluansp')
        ->where('trang_thai', 1)
        ->where('maSP', $id) 
        ->count();
    return $countBinhluansp;
}
function get5Product($idCm,$maSP){
    return DB::table('sanpham')
    ->select('sanpham.*','nhasanxuat.ten_NSX','chitietdanhmucsp.ten_chuyen_muc')
    ->join('chitietdanhmucsp','chitietdanhmucsp.id_chuyen_muc','=','sanpham.id_chuyen_muc')
    ->join('nhasanxuat','nhasanxuat.maNSX','=','sanpham.maNSX')
    ->where('chitietdanhmucsp.id_chuyen_muc',$idCm)
    ->where('maSP','!=',$maSP)
    ->orderBy('sanpham.created_at','DESC')
    ->get();
    // dd($test);
}
function getAllChuyenMucNSX($slug){
    return DB::table('nhasanxuat')
    ->join('nsx_danhmuc', 'nsx_danhmuc.maNSX', '=', 'nhasanxuat.maNSX')
    ->join('chitietdanhmucsp', 'chitietdanhmucsp.id_chuyen_muc', '=', 'nsx_danhmuc.id_chuyen_muc')
    ->join('danhmucsanpham', 'danhmucsanpham.id_danh_muc', '=', 'nsx_danhmuc.id_danh_muc')
    ->join('sanpham', 'sanpham.id_chuyen_muc', '=', 'chitietdanhmucsp.id_chuyen_muc')
    ->where('nhasanxuat.slug', $slug)
    ->distinct()
    ->select('chitietdanhmucsp.*', 'nhasanxuat.*','nhasanxuat.slug as slugNSX','danhmucsanpham.slug as slugDm','chitietdanhmucsp.slug as slugCm')
    ->get();
}
