@extends('layouts.admin')

@section('title')
    Thêm Chuyên Mục Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('getadd_product') }}" class="btn btn-primary">Quay Lại</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('getadd_product') }}" class="btn btn-secondary me-2">Thêm sản phẩm</a>
            <a href="{{route('getadd_nsx')}}"class="btn btn-secondary me-2">Thêm Nhà Sản Xuất</a>
            <a href="{{route('getadd_dm')}}"  class="btn btn-secondary me-2">Thêm Danh Mục</a>
            <a href="{{route('getadd_cm')}}" class="btn btn-danger me-2">Thêm Chuyên Mục</a>
            <a href="{{route('getadd_cm_nsx')}}"  class="btn btn-secondary me-2">Thêm CM cho NSX</a>
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
                <div class="row col-12">
                    <div class="mb-6">
                        <label for="ten_danh_muc" class="form-label">Chọn Danh Mục:</label>
                        <select name="ten_danh_muc" id="ten_danh_muc" class="form-control mb-4">
                            <option value="">Chọn Danh Mục</option>
                            @if(!empty(getAllDanhMucSp2()))
                                @foreach(getAllDanhMucSp2() as $item)
                                    <option value="{{$item->id_danh_muc}}" {{ request()->ten_danh_muc == $item->id_danh_muc ? 'selected' : '' }}>
                                        {{$item->ten_danh_muc}}
                                    </option>
                                @endforeach
                            @endif
                        </select>

                        @error('ten_danh_muc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-6 mb-4">
                        <label for="ten_chuyen_muc" class="form-label">Tên chuyên mục:</label>
                        <input type="text" name="ten_chuyen_muc" id="ten_chuyen_muc" class="form-control" value="{{ old('ten_chuyen_muc') }}">
                        @error('ten_chuyen_muc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-6 mb-4">
                        <label for="slug" class="form-label">Đường dẫn:</label>
                        <input type="text" name="slug" id="slug" class="form-control" readonly style="background-color: #d3d3d3" value="">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-6 mb-4">
                        <label for="anh" class="form-label">Ảnh đại diện chuyên mục:</label>
                        <input type="file" name="anh" id="anh" class="form-control" value="">
                        @error('anh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Thêm Danh Mục</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
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
    const nameInput = document.getElementById('ten_chuyen_muc');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', function() {
        slugInput.value = generateSlug(nameInput.value);
    });
</script>


@endsection
