@extends('layouts.client')

@section('title', 'Cập nhật thông tin')

@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="col-md-3">
                @include('clients.blocks.categoriesUser')
            </div>
            <div class="col-md-9">
                <div class="col-md-7 mt-5" style="margin: 0 auto;">
                    <h5 class="mb-4 text-uppercase font-weight-bold running-text text-center">Cập nhật thông tin tài khoản</h5>

                    <!-- Form chỉnh sửa thông tin người dùng -->
                    <form action="{{-- route('user.update') --}}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="ho_ten" style="margin-bottom: 10px">Họ tên:</label>
                            <input type="text" class="form-control mb-3" id="ho_ten" name="ho_ten" value="{{ Auth::user()->ho_ten }}" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="so_dien_thoai"  style="margin-bottom: 10px">Điện thoại:</label>
                            <input type="text" class="form-control mb-3" id="so_dien_thoai" name="so_dien_thoai" value="{{ Auth::user()->so_dien_thoai }}" required>
                        </div>

                        <div class="form-group">
                            <label for="ngay_sinh"  style="margin-bottom: 10px">Ngày sinh:</label>
                            <input type="date" class="form-control mb-3" id="ngay_sinh" name="ngay_sinh" value="{{ Auth::user()->ngay_sinh }}">
                        </div>

                        <div class="form-group" >
                            <label for="gioi_tinh" style="margin-bottom: 10px">Giới tính:</label>
                            <select class="form-control" id="gioi_tinh" name="gioi_tinh">
                                <option value="1" {{ Auth::user()->gioi_tinh == '1' ? 'selected' : '' }}>Nam</option>
                                <option value="0" {{ Auth::user()->gioi_tinh == '0' ? 'selected' : '' }}>Nữ</option>
                                <option value="2" {{ Auth::user()->gioi_tinh == '2' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>

                            <div class="row gap-3 d-flex justify-content-between">
                                <a href="{{route('home.info-user')}}" type="submit" class="btn btn-warning col-5 mt-3" style="display: block;">Quay lại</a>
                                <button type="submit" class="btn btn-primary col-5 mt-3" style="display: block;">Cập nhật</button>
                            </div>
                 
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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