<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
            'username' => 'required|min:4|unique:taikhoan,username',
            'password' => 'required',
            // 'phone' => 'required|numeric|digits_between:10,12|unique:taikhoan,so_dien_thoai',
            'email' => 'required|unique:taikhoan,email'
        ];
    }
    public function messages(){
        return [
            'username.required' => 'Tài khoản bắt buộc phải nhập',
            'username.unique' => 'Tài khoản đã tồn tại trên hệ thống',
            'username.min' => 'Tài khoản phải lớn hơn 4 ký tự',
            'pasword.required' => 'Mật khẩu bắt buộc phải nhập',
            // 'phone.unique' => 'Số điện thoại đã tồn tại trên hệ thống',
            // 'phone.required' => 'Số điện thoại phải bắt buộc nhập',
            // 'phone.numeric' => 'Số điện thoại phải là số',
            // 'phone.digits_between' => 'Số điện thoại phải từ 10 đến 12 chữ số',
            // 'phone.max' => 'Số điện thoại không dài quá 12 ký tự',
            'email.required' => 'Emal bắt buộc phải nhập',
            'email.unique' => 'Email đã tồn tại trên hệ thống'
        ];
    }
    // public function attributes(){
    //     return [
    //         'username' => 'Tên đăng nhập',
    //         'password' => 'Mật khẩu',
    //         'phone' => 'Số điện thoại',
    //         'email' => 'Email'
    //     ];
    // }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
            }
        });
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            // 'slug' => Str::slug($this->slug),
        ]);
    }
}
