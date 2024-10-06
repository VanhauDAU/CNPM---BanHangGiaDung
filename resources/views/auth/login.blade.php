@extends('layouts.app')

@section('content')
<div class="container col-md-12" style="width:100%">
    <div class="row justify-content-center">
        <div class="content col-md-8" style="display:flex; justify-content:between">
            <div class="image-side" >
                <img src="{{ asset('assets/general/img/login_sidebar.jpg') }}" alt="" class="overlay-image img1" style="border-radius: 15px;">
                <img src="{{ asset('assets/general/img/login_sidebar2.jpg') }}" alt="" class="overlay-image img2" style="border-radius: 15px;">
                <img src="{{ asset('assets/general/img/login_sidebar3.jpg') }}" alt="" class="overlay-image img3" style="border-radius: 15px;">
            </div>
            
            <div class="form-side form-login">
                <form method="POST" class="login-form" action="{{ route('login') }}">
                    @csrf
                    <div class="img text-center" style="margin-bottom: 15px;">
                        <img src="{{asset('assets/general/img/logoDAU_textbottom.png')}}" alt="" style="max-width: 230px">
                    </div>
                    <h2 class="text-center">ĐĂNG NHẬP</h2>
                    @if($errors->any() > 0)
                        <div class="alert alert-danger text-center">
                            
                            Đã có lỗi xảy ra, vui lòng kiểm tra bên dưới!
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="username" class="form-label">Tài Khoản hoặc Email</label>
                        <input type="text" id="username" placeholder="Tài khoản hoặc Email..." name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật Khẩu</label>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    Nhớ mật khẩu
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: #007bff; text-decoration: underline; padding:0;">
                                    Quên mật khẩu?
                                </a>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
                    <a href="http://127.0.0.1:8000/auth/google" class="btn btn-outline-danger btn-block btn-google w-100 mt-2">Đăng nhập qua
                        Google</a>
                    <div class="register mt-3 d-flex justify-content-center align-items-center">
                        <h2 class="me-3 m-0">Bạn chưa có tài khoản?</h2>
                        <a href="{{ route('register') }}" class="btn btn-primary">Đăng Ký Ngay</a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheet')
<style>
    .form-login .register a{
        text-decoration: none;
    }
    .form-login .register h2{
        font-size: 16px;
    }
    .image-side {
        position: relative;
        width: 300px;
        height: 400px;
        margin-right: 160px;
    }

    .image-side img {
        width: 100%;
        height: auto;
    }

    .overlay-image {
        position: absolute;
    }
    .overlay-image:nth-of-type(1){
        top: 30px;
        z-index: -1;
    }
    .overlay-image:nth-of-type(2) {
        bottom: -170px;
        left: -200px;
        z-index: 1;
    }

    .overlay-image:nth-of-type(3) {
        bottom: -50px; /* Điều chỉnh vị trí ảnh thứ 3 */
        left: -80px; /* Điều chỉnh vị trí ảnh thứ 3 */
        z-index: 0; /* Đảm bảo ảnh này nằm dưới ảnh thứ hai */
    }

</style>
@endsection
