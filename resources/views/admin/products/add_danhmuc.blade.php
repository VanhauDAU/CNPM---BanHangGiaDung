@extends('layouts.admin')

@section('title')
    Thêm Danh Mục Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('getadd_product') }}" class="btn btn-primary">Quay Lại</a>
        </div>
    </div>
    
    <div class="card shadow-sm col-md-6">
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
                    <div class="col-md-12">
                        <div class="mb-6">
                            <label for="ten_danh_muc" class="form-label">Tên danh mục:</label>
                            <input type="text" name="ten_danh_muc" id="ten_danh_muc" class="form-control" value="{{ old('ten_danh_muc') }}">
                            @error('ten_danh_muc')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="mb-6 mb-4">
                            <label for="icon" class="form-label">Icon danh mục:</label>
                            <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon') }}">
                            @error('icon')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Thêm Danh Mục</button>
            </form>
        </div>
    </div>
</div>
@endsection
