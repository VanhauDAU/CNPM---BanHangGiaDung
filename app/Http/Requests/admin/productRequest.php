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
            // 'anh'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
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
            // 'anh.required'=>'Vui lòng chọn ảnh sản phẩm',
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
