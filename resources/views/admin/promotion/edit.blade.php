@extends('layouts.admin')

@section('title')
    Sửa Khuyến Mãi {{$promotion->id}}
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('admin.promotions.index') }}" class="btn btn-primary">Quay Lại</a>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{-- route('admin.store_product') --}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger text-center" id="error-message">
                        Vui lòng kiểm tra lại dữ liệu
                    </div>
                @endif

                @if(session('msg'))
                    <div class="alert alert-success text-center">
                        {{session('msg')}}
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ma_khuyen_mai" class="form-label">Mã khuyến mãi:</label>
                            <input type="text" name="ma_khuyen_mai" id="ma_khuyen_mai" class="form-control" readonly style="background-color: #ccc" placeholder="Nhập mã khuyến mãi..." value="{{ old('ma_khuyen_mai',$promotion->ma_khuyen_mai) }}">
                            @error('ma_khuyen_mai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="loai_khuyen_mai" class="form-label">Loại khuyến mãi:</label>
                            <select name="loai_khuyen_mai" id="loai_khuyen_mai" class="form-select">
                                <option value="0" {{ old('loai_khuyen_mai',$promotion->loai_khuyen_mai) == 0 ? 'selected' : '' }}>Giảm theo số tiền</option>
                                <option value="1" {{ old('loai_khuyen_mai',$promotion->loai_khuyen_mai) == 1  ? 'selected' : '' }}>Giảm theo phần trăm</option>
                                <option value="2" {{ old('loai_khuyen_mai',$promotion->loai_khuyen_mai) == 2 ? 'selected' : '' }}>Miễn phí vận chuyển</option>
                                <option value="3" {{ old('loai_khuyen_mai',$promotion->loai_khuyen_mai) == 3 ? 'selected' : '' }}>Tặng quà kèm theo</option>
                            </select>
                            @error('loai_khuyen_mai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="so_luong_su_dung" class="form-label">Số lượng sử dụng:</label>
                            <input type="number"
                                    name="so_luong_su_dung"
                                    id="so_luong_su_dung"
                                    class="form-control"
                                    value="{{old('so_luong_su_dung',$promotion->so_luong_su_dung)}}"
                                    min="1">
                            @error('so_luong_su_dung')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ngay_bat_dau" class="form-label">Ngày bắt đầu:</label>
                            <input type="datetime-local" class="form-control" name="ngay_bat_dau" id="ngay_bat_dau" value="{{old('ngay_bat_dau',$promotion->ngay_bat_dau)}}">
                            @error('ngay_bat_dau')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ngay_ket_thuc" class="form-label">Ngày kết thúc:</label>
                            <input type="datetime-local" class="form-control" name="ngay_ket_thuc" id="ngay_ket_thuc" value="{{old('ngay_ket_thuc',$promotion->ngay_ket_thuc)}}">
                            @error('ngay_ket_thuc')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ten_khuyen_mai" class="form-label">Tên khuyến mãi:</label>
                            <input type="text" name="ten_khuyen_mai" id="ten_khuyen_mai" class="form-control" value="{{ old('ten_khuyen_mai',$promotion->ten_khuyen_mai) }}">
                            @error('ten_khuyen_mai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Đường dẫn:</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Đường dẫn..." readonly style="background-color: #ccc" value="{{ old('slug',$promotion->slug) }}">
                        </div>
                        <div class="mb-3">
                            <label for="gia_tri_khuyen_mai" class="form-label">Giá trị khuyến mãi: (VNĐ)</label>
                            <input type="number"
                                    name="gia_tri_khuyen_mai"
                                    id="gia_tri_khuyen_mai"
                                    class="form-control"
                                    value="{{old('gia_tri_khuyen_mai',$promotion->gia_tri_khuyen_mai)}}" >
                            @error('gia_tri_khuyen_mai')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="trang_thai" class="form-label">Trạng thái:</label>
                            <select name="trang_thai" id="trang_thai" class="form-select">
                                <option value="0" {{ old('trang_thai',$promotion->trang_thai) ==0  ? 'selected' : '' }}>Kích hoạt</option>
                                <option value="1" {{ old('trang_thai',$promotion->trang_thai) == 1 ? 'selected' : '' }}>Không kích hoạt</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="mo_ta" class="form-label">Mô tả khuyến mãi:</label>
                            <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta',$promotion->mo_ta) }}</textarea>
                            @error('mo_ta')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Thêm khuyến mãi</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('stylesheet')
    <style>
    </style>
@endsection
@section('js')
<script>
    const nameInput = document.getElementById('ten_khuyen_mai');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', function() {
        slugInput.value = generateSlug(nameInput.value);
    });
    function removeVietnameseTones(str) {
        return str
            .normalize('NFD') 
            .replace(/[\u0300-\u036f]/g, '') 
            .replace(/đ/g, 'd')
            .replace(/Đ/g, 'D'); 
    }
    function generateSlug(value) {
        let slug = removeVietnameseTones(value); 
        return slug
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }
</script>

@endsection
