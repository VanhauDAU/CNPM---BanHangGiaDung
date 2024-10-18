<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\contacts;
class ContactController extends Controller
{
    //
    private $contacts;
    private $data=[];
    public function __construct(){
        $this->contacts = new contacts();
    }
    public function get_add_contact(){
        $this->data['title'] = "Liên Hệ";
        return view('clients.contact.index', $this->data);
    }
    public function post_add_contact(Request $request){
        $request->validate([
            'ho_ten'=>'required',
            'email'=>'required|email',
            'so_dien_thoai'=>'required|numeric|digits_between:10,12',
            'noi_dung'=>'required|min:10'
        ],[
            'required'=>':attribute bắt buộc phải nhập',
            'email'=>':attribute không đúng định dạng',
            'digits_between'=>':attribute phải từ 10 đến 12 ký tự',
            'min'=>':attribute không được ít hơn :min ký tự',
        ],[
            'ho_ten'=>'Họ tên',
            'email'=>'Email',
            'so_dien_thoai'=>'Số điện thoại',
            'noi_dung'=>'Nội dung',
        ]);
        $dataInsert=[
            $request->ho_ten,
            $request->email,
            $request->so_dien_thoai,
            $request->noi_dung,
        ]; 
        $this->contacts->addContact($dataInsert);
        // return redirect()->route('home.lien-he')->with('success', 'Đã gửi thông tin thành công');
        return redirect()->back()->with('success', 'Đã gửi thông tin thành công');
    }
}
