
@extends('layouts.admin')

@section('title')
    Cập Nhật Người Dùng
@endsection

@section('content-admin')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">{{$title}}</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="username">Tài Khoản</label>
                <input type="text" id="username" name="username" class="form-control" value="{{old('username') ?? $userDetail->username}}">
                @error('username')
                        <span style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" class="form-control" value="{{old('password') ?? $userDetail->password}}" >
                @error('password')
                    <span style="color:red;">Vui lòng nhập mật khẩu</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone">SĐT</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{old('phone') ?? $userDetail->so_dien_thoai}}">
                @error('phone')
                        <span style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{old('email') ?? $userDetail->email}}" >
                @error('email')
                    <span style="color:red;">Vui lòng nhập email</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="address">Họ và Tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ và tên..." value="{{old('fullname') ?? $userDetail->ho_ten}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="address">Ngày Sinh</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="{{old('birthday') ?? $userDetail->ngay_sinh}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cccd">CCCD</label>
                <input type="text" class="form-control" id="cccd" name="cccd" placeholder="Nhập CCCD..." value="{{old('cccd') ?? $userDetail->cccd}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="cccd">Giới tính</label>
                <select name="gender" id="gender"  class="form-control">
                    <option value="1" {{ old('gender', $userDetail->gioi_tinh) == 1 ? 'selected' : '' }}>Nam</option>
                    <option value="0"{{ old('gender', $userDetail->gioi_tinh) == 0? 'selected' : '' }}>Nữ</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="address">Địa Chỉ</label>
            <textarea id="address" name="address" class="form-control" rows="3">{{ old('address') ?? $userDetail->dia_chi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="account_type">Loại Tài Khoản</label>
            <select id="account_type" name="account_type" class="form-control">
                <option value="1" {{ old('account_type', $userDetail->loai_tai_khoan) == 1 ? 'selected' : '' }}>Admin</option>
                <option value="0" {{ old('account_type', $userDetail->loai_tai_khoan) == 0 ? 'selected' : '' }}>Người Dùng</option>
            </select>
            
        </div>
        <div class="mb-3" style="margin-top:5px" name="chuc_vu">
            <label for="chuc_vu">Chức vụ</label>
            <select id="chuc_vu" name="chuc_vu" class="form-control">
                @if(!empty(getAllGroups()))
                    @foreach(getAllGroups() as $item)
                        <option value="{{$item->maCV}}" 
                            {{ old('chuc_vu', $userDetail->maCV) == $item->maCV ? 'selected' : '' }}>
                            {{$item->ten_chuc_vu}}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>        

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Cập Nhật</button>
            <a href="{{route('admin.manage_user')}}" class="btn btn-primary" style="margin-top:30px; background-color:orange; outline: none; border: none;">Quay Lại</a>
        </div>
    </form>
</div>
@endsection
