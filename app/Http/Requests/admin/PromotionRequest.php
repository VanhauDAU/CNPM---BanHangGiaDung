<?php

namespace App\Http\Requests\admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            //
            'ma_khuyen_mai' => [
                'required',
                'min:4',
                Rule::unique('khuyenmai', 'ma_khuyen_mai')->ignore($id), // Bỏ qua mã khuyến mãi hiện tại nếu đang edit
            ],
            'ten_khuyen_mai'=>'required',
            'ngay_bat_dau'=>'required|date',
            'ngay_ket_thuc'=>'required|date|after:ngay_bat_dau',
            'gia_tri_khuyen_mai'=>'required|numeric|min:0'
        ];
    }
    public function messages(): array
    {
        return [
            'ma_khuyen_mai.required'=>':attribute không được bỏ trống',
            'ma_khuyen_mai.min'=>':attribute ít nhất :min ký tự',
            'ma_khuyen_mai.unique'=>':attribute đã tồn tại',
            'ten_khuyen_mai.required'=>':attribute không được bỏ trống',
            'ngay_bat_dau.required'=>':attribute không được bỏ trống',
            'ngay_ket_thuc.required'=>':attribute không được bỏ trống',
            'ngay_ket_thuc.after' => ':attribute phải lớn hơn ngày bắt đầu',
            'gia_tri_khuyen_mai.required'=>':attribute không được bỏ trống',
            'gia_tri_khuyen_mai.numeric'=>':attribute phải là một số',
            'gia_tri_khuyen_mai.min'=>':attribute phải lớn hơn :min',
        ];
    }
    public function attributes()
    {
        return [
            'ma_khuyen_mai' => 'Mã khuyến mãi',
            'ten_khuyen_mai' => 'Tên khuyến mãi',
            'ngay_bat_dau' =>'Ngày bắt đầu',
            'ngay_ket_thuc' =>'Ngày kết thúc',
            'gia_tri_khuyen_mai' => 'Giá trị khuyến mãi',
        ];
    }
}
