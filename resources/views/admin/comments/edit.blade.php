@extends('layouts.admin')

@section('title')
    Cập Nhật Bình Luận
@endsection

@section('content-admin')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Cập Nhật Trạng Thái Bình Luận</h1>

    <form action="{{ route('postedit_cmt', $cmtDetail->id) }}" method="POST">
        @csrf
        
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="ho_ten">Họ và Tên</label>
                <input type="text" id="ho_ten" name="ho_ten" class="form-control" 
                       value="{{ old('ho_ten', $cmtDetail->ho_ten ?? $cmtDetail->ho_ten_KHVL) }}" readonly>
            </div>            

            <div class="col-md-6 mb-3">
                <label for="ten_san_pham">Tên Sản Phẩm</label>
                <input type="text" id="ten_san_pham" name="ten_san_pham" class="form-control" value="{{ old('ten_san_pham', $cmtDetail->ten_san_pham) }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="so_dien_thoai">SĐT</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai', $cmtDetail->so_dien_thoai_KHVL??$cmtDetail->so_dien_thoai) }}" readonly>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $cmtDetail->email_KHVL ?? $cmtDetail->email) }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="noi_dung">Nội Dung</label>
                <input type="text" class="form-control" value="{{ old('noi_dung', $cmtDetail->noi_dung) }}" readonly>
            </div>
        </div>
        

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="gioi_tinh">Giới Tính</label>
                <input type="text" id="gioi_tinh" name="gioi_tinh" class="form-control" 
                       value="{{ old('gioi_tinh', $cmtDetail->gioi_tinh_KHVL ?? ($cmtDetail->gioi_tinh == 1 ? 'Nam' : 'Nữ')) }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="trang_thai">Trạng Thái</label>
                <select name="trang_thai" id="trang_thai" class="form-control">
                    <option value="1" {{ old('trang_thai', $cmtDetail->trang_thai) == 1 ? 'selected' : '' }}>Hiện</option>
                    <option value="0" {{ old('trang_thai', $cmtDetail->trang_thai) == 0 ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Cập Nhật</button>
            <a href="{{ route('admin.manage_cmt') }}" class="btn btn-primary" style="margin-top:30px; background-color:orange; outline: none; border: none;">Quay Lại</a>
        </div>
    </form>
</div>
@endsection
