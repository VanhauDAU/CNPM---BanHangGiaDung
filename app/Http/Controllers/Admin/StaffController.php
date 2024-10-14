<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Staffs;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\modules;

class StaffController extends Controller
{
    //
    public function index(){
        $title ='Quản Lý Nhóm Người Dùng';
        $lists = Staffs::all();
        return view('admin.staff.index',compact('lists','title'));
    }
    public function add(){
        return view('admin.staff.add');
    }
    public function postAdd(Request $request){
        $request->validate([
            'ten_chuc_vu'=>'required|unique:chucvu,ten_chuc_vu'
        ],[
            'ten_chuc_vu.required'=>'Tên nhóm người dùng bắt buộc phải nhập',
            'ten_chuc_vu.unique'=>'Tên nhóm người dùng bị trùng, vui lòng chọn tên khác',
        ]);
        $staff = new Staffs();
        $staff->ten_chuc_vu = $request->ten_chuc_vu;
        $staff->user_id = Auth::user()->id;
        $staff->save();
        return redirect()->route('admin.staffs.index')->with('success','Thêm nhóm thành công');
    }
    public function edit(Staffs $staff){
        $this->authorize('update',$staff);
        return view('admin.staff.edit',compact('staff'));
    }
    public function postEdit(Staffs $staff, Request $request){
        $this->authorize('update',$staff);
        $request->validate([
            'ten_chuc_vu'=>'required|unique:chucvu,ten_chuc_vu'
        ],[
            'ten_chuc_vu.required'=>'Tên nhóm người dùng bắt buộc phải nhập',
            'ten_chuc_vu.unique'=>'Tên nhóm người dùng bị trùng, vui lòng chọn tên khác',
        ]);
        $staff->ten_chuc_vu = $request->ten_chuc_vu;
        $staff->save();
        return back()->with('success','Cập nhật nhóm thành công');
    }
    public function delete(Staffs $staff){
        $this->authorize('delete',$staff);
        $userCount = $staff->users->count();
        if($userCount == 0){
            Staffs::destroy($staff->maCV);
            return redirect()->route('admin.staffs.index')->with('success','Xóa nhóm thành công');
        }
        return redirect()->route('admin.staffs.index')->with('warning','Trong nhóm vẫn còn '.$userCount.' người dùng');
    }
    public function phanQuyen(Staffs $staff){
        $modules = modules::all();
        $roleListArr = [
            'view'=>'Xem',
            'add'=>'Thêm',
            'edit'=>'Sửa',
            'delete'=>'Xóa',
        ];

        $roleJson = $staff->phan_quyen;
        if(!empty($roleJson)){
            $roleArr = json_decode($roleJson, true);
        }else{
            $roleArr = [];
        }
        return view('admin.staff.permission',compact('staff','modules','roleListArr','roleArr'));
    }
    public function postPhanQuyen(Staffs $staff, Request $request){
        if(!empty($request->role)){
            $roleArr = $request->role;
        }else{
            $roleArr = [];
        }
        $roleJson = json_encode($roleArr);
        $staff->phan_quyen = $roleJson;
        $staff->save();
        return back()->with('success','Phân quyền thành công');
    }
}
