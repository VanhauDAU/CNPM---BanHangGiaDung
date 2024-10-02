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
        <div class="col-auto">
            <a href="{{route('getadd_nsx')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Nhà Sản Xuất</a>
            <a href="{{route('getadd_dm')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Danh Mục</a>
            <a href="{{route('getadd_cm')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Chuyên Mục</a>
            <a href="{{route('getadd_cm_nsx')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm CM cho NSX</a>
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
                    <div class="mb-6 mb-4">
                        <label for="slug" class="form-label">Đường dẫn:</label>
                        <input type="text" name="slug" id="slug" class="form-control" readonly style="background-color: #d3d3d3" value="">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Thêm Danh Mục</button>
            </form>
        </div>
    </div>

    {{-- Bảng liệt kê danh mục --}}
    <div class="card shadow-sm col-md-12 mt-4">
        <div class="card-body">
            <h5 class="card-title">Danh Sách Danh Mục</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên Danh Mục</th>
                        <th>Icon</th>
                        <th>Đường dẫn</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(getAllDanhMucSp2() as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->ten_danh_muc }}</td>
                            <td>
                                <img src="{{ $category->icon }}" alt="" style="width: 24px">
                                {{ $category->icon }}
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                {{-- <a href="{{ route('admin.edit_category', $category->id) }}" class="btn btn-warning btn-sm">Sửa</a> --}}
                                <form action="{{-- route('admin.delete_category', $category->id) --}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    const nameInput = document.getElementById('ten_danh_muc');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', function() {
        slugInput.value = generateSlug(nameInput.value);
    });
</script>
@endsection
