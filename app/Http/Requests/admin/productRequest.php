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
            'maNSX' => 'required',
            'id_danh_muc' => 'required',
            'id_chuyen_muc'=>'required',
            'ten_san_pham' => 'required|unique:taikhoan,email',
            'don_gia'=>'required|numeric',
            'don_gia_goc'=>'required|numeric',
            // 'anh'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            
        ];
    }
    public function messages(){
        return [
            'maNSX.required' => 'Mã NSX bắt buộc phải nhập',
            'id_danh_muc.required' => 'Loại sản phẩm bắt buộc phải nhập',
            'id_chuyen_muc'=>'Chuyên mục bắt buộc phải chọn',
            'ten_san_pham.unique' => 'Tên sản phẩm đã tồn tại trên hệ thống',
            'ten_san_pham.required' => 'Tên sản phẩm bắt buộc phải nhập',
            'don_gia.required'=>'Đơn giá bắt buộc phải nhập',
            'don_gia.numeric'=>'Đơn giá bắt buộc phải là số',
            'don_gia_goc.required'=>'Đơn giá gốc bắt buộc phải nhập',
            'don_gia_goc.numeric'=>'Đơn giá gốc bắt buộc phải là số',
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
