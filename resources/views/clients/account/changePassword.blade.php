@extends('layouts.client')
@section('title')
    {{ Auth::user()->ho_ten }} - {{$title}}
@endsection

@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="col-md-3">
                @include('clients.blocks.categoriesUser')
            </div>
            <div class="col-md-9 mx-auto">
                <div class="col-md-7 user-details mt-5" style="margin: 0 auto;">
                    <h5 class="mb-4 text-uppercase font-weight-bold running-text text-center">ĐỔI MẬT KHẨU</h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="old_password">Mật khẩu cũ:</label>
                            <input type="password" name="old_password" class="form-control" placeholder="Mật khẩu cũ...">
                            @error('old_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password">Mật khẩu mới:</label>
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới...">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Nhập lại mật khẩu mới:</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu mới...">
                            @error('confirm_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary col-md-12" style="background-color: #DA251C; border-color:#DA251C">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@endsection
@section('stylesheetAccount')
<style>
    .main-posts{
        background-color: #F3F4F6;
    }
</style>
@endsection