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
function getChuyenMuc2($id){
    $groups = new Groups();
    return $groups->getChuyenMuc2($id);
}
function getChuyenMuc3($id){
    $groups = new Groups();
    return $groups->getChuyenMuc3($id);
}
function getChuyenMucCountByNSXAndDanhMuc($maNSX, $idDanhMuc)
{
    $groups = new Groups();
    return $groups->getChuyenMucCountByNSXAndDanhMuc($maNSX, $idDanhMuc);
}
