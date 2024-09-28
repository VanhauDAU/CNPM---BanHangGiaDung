@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 d-flex justify-content-center align-items-center" style="width:100vw;" >
            <div class="image-side" style="max-width: 300px">
                <img src="{{asset('assets/admin/img/login_sidebar.png')}}" alt="">
            </div>
            <div class="card ms-5 form-register"style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; min-width: 400px;" >
                <div class="card-header text-center"><strong>Đăng Ký Tài Khoản</strong></div>

                <div class="card-body">
                    {{-- @if($errors->any())
                        <div class="alert alert-danger text-center">
                            Đã có lỗi xảy ra, vui lòng kiểm tra bên dưới!
                        </div>
                    @endif --}}
                    @if(session('msg'))
                        <div class="alert alert-success text-center">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-1">
                            <label for="username" class="col-form-label">Tài khoản <span style="color:red;">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" autocomplete="username" autofocus>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-1">
                            <label for="email" class="col-form-label">Địa chỉ email <span style="color:red;">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-1">
                            <label for="name" class="col-form-label">Họ tên</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group mb-1 col-6">
                                <label for="password" class="col-form-label">Mật khẩu <span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group mb-2 col-6">
                                <label for="password-confirm" class="col-form-label">Nhập lại mật khẩu <span style="color:red;">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="submit-register btn w-100 btn-primary" style="min-width: 150px;">
                                    Đăng Ký
                                </button>
                            </div>
                        </div>
                        <div class="register mt-3 d-flex justify-content-center align-items-center">
                            <h2 class="me-3 m-0 fs-5">Bạn đã có tài khoản?</h2>
                            <a href="{{ route('login') }}" class="btn btn-primary">Đăng Nhập Ngay</a>

                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheet')
<style>
    body {
        overflow: hidden;
    }
    .form-register{
        transition: .5s ease;
    }
    .form-register:hover{
        translate: 0 -4px;
        cursor: pointer;
    }

    .submit-register:hover{
        background-color: #0B5ED7;
        color:white;
    }
</style>
@endsection
