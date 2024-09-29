<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NSXRequest extends FormRequest
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
            // 'id_danh_muc'=>'required|not_in',
            'ten_NSX'=>'required',
            'so_dien_thoai'=>'required|digits_between:10,12'
        ];
    }
    public function messages(){
        return [
            // 'id_danh_muc.not_in'=>'Bạn phải chọn loại sản phẩm',
            // 'id_danh_muc.required'=>'Bạn phải chọn loại sản phẩm',
            'ten_NSX.required'=>'Tên nhà sản xuất không được bỏ trống',
            'so_dien_thoai.required'=>'Số điện thoại không được bỏ trống',
            'so_dien_thoai.digits_between'=>'Số điện thoại phải từ 10-12 ký tự'
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
