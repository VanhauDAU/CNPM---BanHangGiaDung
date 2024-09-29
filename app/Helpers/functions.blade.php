<?php
use App\Models\admin\Groups;
use App\Models\admin;
function getAllGroups(){
    $group = new Groups;
    return $group->getAll();
}
function getAllDanhMucSp(){
    $group = new Groups;
    return $group->getAllDanhMucSp();
}
function getAllNSX(){
    $group = new Groups;
    return $group->getAllNSX();
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