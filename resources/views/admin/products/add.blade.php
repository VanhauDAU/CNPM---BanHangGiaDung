@extends('layouts.admin')

@section('title')
    Thêm Sản Phẩm Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('admin.manage_product') }}" class="btn btn-primary">Quay Lại</a>
        </div>
        <div class="col-auto">
            <a href="{{route('getadd_nsx')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Nhà Sản Xuất</a>
            <button id="btn-add-danh_muc" class="btn btn-danger">Thêm Danh Mục</button>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{-- route('admin.store_product') --}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger text-center" id="error-message">
                        @foreach($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
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
                            <label for="maSP" class="form-label">Mã sản phẩm:</label>
                            <input type="text" name="maSP" id="maSP" class="form-control" value="{{ old('maSP') }}">
                            @error('maSP')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="maNSX" class="form-label">Nhà sản xuất:</label>
                            <select name="maNSX" id="maNSX" class="form-select">
                                <option value="">Chọn nhà sản xuất</option>
                                @if(!empty(getAllNSX()))
                                    @foreach(getAllNSX() as $item)
                                        <option value="{{ $item->maNSX }}" {{ old('maNSX') == $item->maNSX ? 'selected' : '' }}>{{ $item->ten_NSX }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('maNSX')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nhomSP" class="form-label">Loại sản phẩm:</label>
                            <select name="nhomSP" id="nhomSP" class="form-select">
                                <option value="">Chọn loại sản phẩm</option>
                                @if(!empty(getAllDanhMucSp()))
                                    @foreach(getAllDanhMucSp() as $item)
                                        <option value="{{ $item->nhomSP }}" {{ old('nhomSP') == $item->nhomSP ? 'selected' : '' }}>{{ $item->ten_nhom }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('nhomSP')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="don_gia" class="form-label">Giá (VNĐ):</label>
                            <input type="number" name="don_gia" id="don_gia" class="form-control" value="{{ old('don_gia') }}">
                            @error('don_gia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh sản phẩm:</label>
                            <input type="file" name="hinh_anh" id="hinh_anh" class="form-control" accept="image/*" value="{{ old('hinh_anh') }}">
                            @error('hinh_anh')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="ten_san_pham" class="form-label">Tên sản phẩm:</label>
                            <input type="text" name="ten_san_pham" id="ten_san_pham" class="form-control" value="{{ old('ten_san_pham') }}">
                            @error('ten_san_pham')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            
                        </div>

                        <div class="mb-3">
                            <label for="so_luong_ton" class="form-label">Số lượng nhập:</label>
                            <input type="number" name="so_luong_ton" id="so_luong_ton" class="form-control" value="{{ old('so_luong_ton') }}">
                            @error('so_luong_ton')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="trong_luong" class="form-label">Trọng lượng:</label>
                            <input type="number" name="trong_luong" id="trong_luong" class="form-control" value="{{ old('trong_luong') }}">
                            @error('trong_luong')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mo_ta" class="form-label">Mô tả sản phẩm:</label>
                            <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta') }}</textarea>
                            @error('mo_ta')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>
@endsection
