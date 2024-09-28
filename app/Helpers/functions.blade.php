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