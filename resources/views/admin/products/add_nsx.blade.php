@extends('layouts.admin')

@section('title')
    Thêm Nhà Sản Xuất Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('getadd_product') }}" class="btn btn-primary">Quay Lại</a>
        </div>
        <div class="col-auto">
            <button id="btn-add-danh_muc" class="btn btn-danger">Thêm Danh Mục</button>
        </div>
    </div>
    
    <div class="card shadow-sm col-md-12">
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
                            <label for="ten_NSX" class="form-label">Tên nhà sản xuất:</label>
                            <input type="text" name="ten_NSX" id="ten_NSX" class="form-control" value="{{ old('ten_NSX') }}">
                            @error('ten_NSX')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="so_dien_thoai" class="form-label">Số điện thoại:</label>
                            <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control" value="{{ old('so_dien_thoai') }}">
                            @error('so_dien_thoai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">  
                            <label for="dia_chi" class="form-label">Địa chỉ:</label>
                            <textarea name="dia_chi" id="dia_chi" class="form-control" rows="4">{{ old('dia_chi') }}</textarea>
                            @error('dia_chi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-success w-100">Thêm Nhà Sản Xuất</button>
            </form>
        </div>
    </div>
</div>

@endsection
