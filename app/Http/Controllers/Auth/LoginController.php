<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\clients\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class LoginController extends Controller 
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function username()
    {
        return 'username';
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        toastr()->success('Thành công','Đăng xuất thành công');
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login'));
    }
    public function login(Request $request){
        $this->validateLogin($request);
     
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $user = Auth::user();
            if ($user->loai_tai_khoan != 0) {
                Auth::logout();
                return $this->sendFailedLoginResponse($request);
            }
            // Kiểm tra xem email đã được xác thực chưa
            if ($user->email_verified_at == null) {
                // Auth::logout();
                return redirect()->route('verification.notice')->with('warning', 'Bạn cần xác thực email.');
            }
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
      
    }
    protected function validateLogin(Request $request){
        // dd($request->all());
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:4',
        ],[
            $this->username().'.required'=>'Tên đăng nhập bắt buộc phải nhập',
            $this->username().'.string'=>'Kiểu dữ liệu tên đăng nhập không hợp lệ',
            'password.required'=>'Mật khẩu bắt buộc phải nhập',
            'password.string'=>'Kiểu dữ liệu mật khẩu không hợp lệ',
            'password.min'=>'Mật khẩu phải ít nhất 4 ký tự',
        ]);
    }
    
    protected function sendFailedLoginResponse(Request $request){
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không hợp lệ']
        ]);
    }
    protected function credentials(Request $request)
    {
        if(filter_var($request->username, FILTER_VALIDATE_EMAIL)){
            $fieldDb = 'email';
        }else{
            $fieldDb = 'username';
        }
        
        $dataArr = [
            $fieldDb => $request->username,
            'password' => $request->password,
            // 'loai_tai_khoan' => 0,
        ];
        return $dataArr;
        // return $request->only($dataArr, 'password');
    }
    // google
    protected function googleCallBack(){
        $usergoogle = Socialite::driver('google')->user();
        $data['title'] = 'TRANG CHỦ';
        $providerID = $usergoogle->getID();
        $provider ='google';
        $user = User::where('provider', $provider)->where('provider_id',$providerID)->first();
        // dd($usergoogle);
        if(!$user){
            $user = new User();
            $user->ho_ten = $usergoogle->getName();
            $user->email = $usergoogle->getEmail();
            $user->username = $usergoogle->getID();
            $user->anh = $usergoogle->getAvatar();
            $user->provider_id = $providerID;
            $user->provider = 'google';
            $user->password = Hash::make(rand());
            $user->save();
        }
        $userUsername = $user->username;
        // dd($userUsername);
        // Auth::loginUsingId($userUsername);
        Auth::login($user);
        $products = Products::all();
        // dd($products);
        // dd($user);
        // return view('clients.home.home', ['title' => $data['title'], 'user' => $user]);
        return view('clients.home.home', [
            'title' => $data['title'],
            'user' => auth()->user(), // Truyền user sau khi đăng nhập
            'productList' => $products // Thêm biến 'products' vào để dùng ở view
        ]);
    }

}