@extends('layouts.app')

@section('content')
<div class="container col-md-12" style="width:100%">
    <div class="row justify-content-center">
        <div class="content col-md-8" style="display:felx; justify-content:between">
            <div class="image-side">
                <img src="{{asset('assets/admin/img/login_sidebar.png')}}" alt="">
            </div>
            <div class="form-side form-login">
                <form method="POST" class="login-form" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="img text-center" style="margin-bottom: 15px;">
                        <img src="{{asset('assets/general/img/logoDAU_textbottom.png')}}" alt="" style="max-width: 230px">
                    </div>
                    <h2 class="text-center">ĐĂNG NHẬP QUẢN TRỊ</h2>
                    @if($errors->any() > 0)
                        <div class="alert alert-danger text-center">
                            Đã có lỗi xảy ra, vui lòng kiểm tra bên dưới!
                        </div>
                    @endif
                    @if(session('msg'))
                        <div class="alert alert-danger text-center">
                            {{session('msg')}}
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="username" class="form-label">Tài Khoản</label>
                        <input type="text" id="username" placeholder="Tài khoản..." name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" autofocus>
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
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheet')
<style>
    body{
        overflow: hidden;
    }
    .form-login .register a{
        text-decoration: none;
    }
    .form-login .register h2{
        font-size: 16px;
    }
</style>
@endsection
