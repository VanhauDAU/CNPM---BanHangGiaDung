<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'maSP' => 'required|unique:sanpham,maSP|min:3',
            'maNSX' => 'required',
            'nhomSP' => 'required',
            'ten_san_pham' => 'required|unique:taikhoan,email',
            'don_gia'=>'required|numeric',
            'maNSX'=>'required|not_in',
            'nhomSP'=>'required|not_in',
            'ten_NSX'=>'required',
            'so_dien_thoai'=>'required|digits_between:10,12',
            'email'=>'required|email'
        ];
    }
    public function messages(){
        return [
            'maSP.required' => 'Mã sản phẩm bắt buộc phải nhập',
            'maSP.unique' => 'Mã sản phẩm đã tồn tại trên hệ thống',
            'maSP.min' => 'Mã sản phẩm phải lớn hơn :min ký tự',
            'maNSX.required' => 'Mã NSX bắt buộc phải nhập',
            'nhomSP.required' => 'Loại sản phẩm bắt buộc phải nhập',
            'ten_san_pham.unique' => 'Tên sản phẩm đã tồn tại trên hệ thống',
            'ten_san_pham.required' => 'Tên sản phẩm bắt buộc phải nhập',
            'don_gia.required'=>'Đơn giá bắt buộc phải nhập',
            'don_gia.numeric'=>'Đơn giá bắt buộc phải là số',
            'maNSX.required'=>'Bạn phải chọn nhà sản xuất',
            'maNSX.not_in'=>'Bạn phải chọn nhà sản xuất',
            'nhomSP.not_in'=>'Bạn phải chọn loại sản phẩm',
            'nhomSP.required'=>'Bạn phải chọn loại sản phẩm',
            'ten_NSX.required'=>'Tên nhà sản xuất không được bỏ trống',
            'so_dien_thoai.required'=>'Số điện thoại không được bỏ trống',
            'so_dien_thoai.digits_between'=>'Số điện thoại phải từ 10-12 ký tự',
            'email.required'=>'Email không được bỏ trống',
            'email.email'=>'Email không đúng định dạng'
        ];
    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
            }
        });
    }
}
