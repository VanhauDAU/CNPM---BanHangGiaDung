<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Users;
use App\Http\Requests\admin\userRequest;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    private $users;
    //nên có 1 option trong trang quản trị để hiển thị số lượng phân trang
    const _PER_PAGE = 4;
    public function __construct(){
        $this->users = new Users();
    }
    public $data=[];
    public function index(){
        return view('admin.dashboard.index');
    }
    //======================QUẢN LÝ TÀI KHOẢN=======================
    
    public function manage_user(Request $request){

        $title = 'DANH SÁCH NGƯỜI DÙNG';
        // $users = new Users();
        $filters =[];
        $keyword = null;
        if(!empty($request->chuc_vu)){
            $ma_CV = $request->chuc_vu;
            $filters[] = ['taikhoan.maCV', '=',$ma_CV];
        }
        
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
        }
        //Xử lý logic sắp xếp theo cột
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $arrSort =['ASC', 'DESC'];
        if(!empty($sortType) & in_array($sortType,$arrSort)){
            if($sortType=='DESC'){
                $sortType ='ASC';
            }else{
                $sortType ='DESC';
            }
        }else{
            $sortType ='ASC';
        }
        $sortArr =[
            'sortBy'=>$sortBy,
            'sortType'=>$sortType
        ];
        //end xử lý
        $userList = $this->users->getAllUsers($filters, $keyword,$sortArr, self::_PER_PAGE);
        return view('admin.users.index', compact('title', 'userList','sortType'));
    }
    public function get_add_user(){
        $this->data['title'] = "THÊM NGƯỜI DÙNG";
        $this->data['massage'] = "Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!";
        return view('admin.users.add', $this->data);
    }
    public function post_add_user(userRequest $request){
        $fileName = null;
        if ($request->has('hinh_anh')) {
            $file = $request->hinh_anh;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time().'-'.$ext;
            $file->move(public_path('storage/users/img'), $fileName);
            // $anh = 'storage/products/img'.$file;
        }
        $dataInsert=[
            $request->username,
            Hash::make($request->password),
            $request->fullname,
            $request->birthday,
            $request->phone,
            $request->email,
            $request->account_type,
            $request->chuc_vu,
            $fileName,
        ];  
        $this->users->addUser($dataInsert);
        toastr()->success('Thành công','Thêm người dùng thành công');
        return redirect()->route('admin.manage_user')->with('msg', 'Thêm mới người dùng thành công');
    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
            }
        });
    }
    public function get_info_detail($id = 0){
        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            if(!empty($userDetail[0])){
                $userDetail = $userDetail[0];
            }else{
                return redirect()->route('admin.manage_user')->with('msg','Tài khoản không tồn tại');
            }
        }else{
            return redirect()->route('manage_user')->with('msg','Mã tài khoản không tồn tại');
        }
        return view('admin.users.info_user', compact('userDetail'));
    }
    public function get_edit_user($id = 0){
        $title = "CẬP NHẬT NGƯỜI DÙNG";
        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            // dd($userDetail[0]);
            if(!empty($userDetail[0])){
                $userDetail = $userDetail[0];
            }else{
                return redirect()->route('admin.manage_user')->with('msg','Tài khoản không tồn tại!');
            }
        }else{
            return redirect()->route('admin.manage_user')->with('msg','Mã Tài Khoản Không Tồn Tại');
        }
        return view('admin.users.edit', compact('title','userDetail'));
    }
    public function post_edit_user(Request $request,$id = 0){
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $users = $this->users->getDetail($id);
        $fileName = null;
        if ($request->has('hinh_anh')) {
            $file = $request->hinh_anh;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time() . '-' . $ext;
            $file->move(public_path('storage/users/img/'), $fileName);
            if ($users && !empty($users->anh)) {
                $oldImagePath = public_path('storage/users/img/' . $users['anh']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $fileName = $request->hinh_anh_cu;
        }
        $request->validate([
            'username' => 'required|min:5|unique:taikhoan,username,'.$id.',username',
            'password' => 'required',
            'cccd' => 'max:12',
            'email' => 'required'
        ],[
            'username.required' => 'Tài khoản bắt buộc phải nhập',
            'username.unique' => 'Tài khoản đã tồn tại trên hệ thống',
            'username.min' => 'Tài khoản bắt buộc lớn hơn 4 ký tự',
            'pasword.required' => 'Mật khẩu bắt buộc phải nhập',
            'cccd.max'=>'CCCD nhiều nhất 12 ký tự',
            'email.required' => 'Email bắt buộc phải nhập'
        ]);
        $dataUpdate = [
            $request->username,
            $request->password,
            $request->fullname,
            $request->birthday,
            $request->phone,
            $request->email,
            $request->gender,
            $request->cccd,
            $request->account_type,
            $request->chuc_vu,
            $fileName,
            
        ];
        $this->users->updateUser($dataUpdate, $id);
        return redirect()->route('admin.edit_user',['id'=>$id])->with('msg','Cập nhật người dùng thành công!');
    }
    public function get_delete_user($id){
        if(!empty($id)){
            $userDetail = $this->users->getDetail($id);
            // dd($userDetail[0]);
            if(!empty($userDetail[0])){
                $deleteuser = $this->users->deleteUser($id);
                if($deleteuser){
                    $msg = 'Xóa người dùng thành công';
                }else{
                    $msg = 'Bạn không thể xóa người dùng lúc này, vui lòng thử lại sau!';
                }
            }else{
                $msg ='Tài khoản không tồn tại!';
            }
        }else{
            $msg = 'Liên kết không tồn tại';
        }
        toastr()->warning('Thành công','Xóa tài khoản thành công');
        return redirect()->route('admin.manage_user')->with('msg',$msg);
    }
    //======================KẾT THÚC QUẢN LÝ TÀI KHOẢN=======================
}
