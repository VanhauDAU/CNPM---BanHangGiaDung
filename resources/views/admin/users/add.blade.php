
@extends('layouts.admin')

@section('title')
    Thêm Người Dùng
@endsection

@section('content-admin')
<div class="container">
    <h1 class="text-center mb-4 fw-bold"><i class="fa-solid fa-plus"></i>{{$title}}</h1>

    <form action="{{-- route('admin.add_user') --}}" method="POST">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger text-center">
                Vui lòng kiểm tra lại dữ liệu
            </div>
        @endif
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="username">Tên Tài Khoản</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Nhập tài khoản..." value="{{old('username')}}">
                @error('username')
                        <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="password">Mật Khẩu</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Nhập mật khẩu..." value="{{ old('password') }}" >
                @error('password')
                    <span style="color:red;">Vui lòng nhập mật khẩu</span>
                @enderror
            </div>
        </div>
        <input type="hidden" name="daycreate" value="{{ \Carbon\Carbon::now()->format('Y-m-d H:i:s') }}">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="phone">SĐT</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại..." value="{{old('phone')}}">
                @error('phone')
                        <span style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email..." value="{{old('email')}}" >
                @error('email')
                        <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="address">Họ và Tên</label>
                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ và tên..." value="{{old('fullname')}}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="address">Ngày Sinh</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="{{old('birthday')}}">
            </div>
        </div>
        <div class="mb-3">
                <label for="address">Địa Chỉ</label>
                <textarea id="address" name="address" class="form-control" rows="3" placeholder="Nhập địa chỉ..." value="{{old('address')}}"></textarea>
            </div>
        
        {{-- <div class="mb-3" style="margin-top:5px">
            <label for="account_type">Loại Tài Khoản</label>
            <select id="account_type" name="account_type" class="form-control">
                <option value="1" {{ old('account_type') == '1' ? 'selected' : '' }}>Admin</option>
                <option value="0" {{ old('account_type') == '0' ? 'selected' : '' }}>Người Dùng</option>
            </select>
        </div> --}}
        <input type="hidden" id="hidden_account_type" name="account_type" value="0" >
        <div class="mb-3" style="margin-top:5px" name="chuc_vu" id="chuc_vu_container">
            <label for="chuc_vu">Chức vụ</label>
            <select id="chuc_vu" name="chuc_vu" class="form-control" onchange="checkChucVu()">
                <option value="4">TRỐNG</option>
                @if(!empty(getAllGroups())){
                    @forEach(getAllGroups() as $item)
                        <option value="{{$item->maCV}}" {{request()->chuc_vu == $item->maCV ? 'selected': false}}>{{$item->ten_chuc_vu}}</option>
                    @endforeach
                @endif
                }
            </select>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Thêm Mới</button>
            <a href="{{route('admin.manage_user')}}" class="btn btn-primary" style="margin-top:30px; background-color:orange; outline: none; border: none;">Quay Lại</a>
        </div>
    </form>
</div>

<script>
    function checkChucVu() {
        var chucVu = document.getElementById('chuc_vu').value;
        var hiddenAccountType = document.getElementById('hidden_account_type');

        if (chucVu == '4'||chucVu == '0') {
            hiddenAccountType.value = '0';
        } else {
            hiddenAccountType.value = '1';
        }
    }

    // Gọi hàm để kiểm tra khi trang được tải
    checkAccountType();
    checkChucVu();
</script>
@endsection
