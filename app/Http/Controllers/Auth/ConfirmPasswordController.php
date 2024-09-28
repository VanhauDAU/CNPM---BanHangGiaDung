<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected function validationErrorMessages()
    {
        return [
            'password.required'=>'Mật khẩu bắt buộc phải nhập',
            'current_password'=>'Mật khẩu không chính xác'
        ];
    }
    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        Mail::send([], [], function ($message) use ($name, $email){
            $content ='Chào '.$name.'<br/>';
            $content.='Bạn vừa xác nhận mật khẩu thành công';
            // Sử dụng html() để gửi nội dung HTML
            $message->to($email)
            ->subject('Xác nhận mật khẩu thành công')
            ->html($content);
          });
        
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

}
