<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo = route('register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255','unique:taikhoan'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:taikhoan'],
            'password' => ['required', 'string', 'min:4'],
            'password_confirmation'=>['required','same:password']
        ],[
            'required'=>':attribute bắt buộc phải nhập',
            'string' => ':attribute phải là ký tự',
            'max'=>':attribute không được lớn hơn :max ký tự',
            'min'=>':attribute không được nhỏ hơn :min ký tự',
            'unique' =>':attribute đã tồn tại',
            'email'=>':attribute không đúng định dạng',
            'same'=>':attribute phải giống mật khẩu' 
        ],[
            'username'=>'Tài khoản',
            'email'=>'Địa chỉ email',
            'password'=>'Mật khẩu',
            'password_confirmation'=>'Nhập lại mật khẩu'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'email' => $data['email'],
            'ho_ten' => $data['name'],
            'username'=> $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath())->with('msg','Đăng ký tài khoản thành công, vui lòng xác thực email!');
    }
}
