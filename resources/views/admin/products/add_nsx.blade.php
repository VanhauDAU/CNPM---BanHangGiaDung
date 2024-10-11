@extends('layouts.admin')

@section('title')
    Thêm Nhà Sản Xuất Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quay Lại</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.products.addProduct') }}" class="btn btn-secondary me-2">Thêm sản phẩm</a>
            <a href="{{route('admin.products.addNsx')}}"  class="btn btn-danger me-2">Thêm Nhà Sản Xuất</a>
            <a href="{{route('admin.products.addDm')}}"  class="btn btn-secondary me-2">Thêm Danh Mục</a>
            <a href="{{route('admin.products.addCm')}}"  class="btn btn-secondary me-2">Thêm Chuyên Mục</a>
            <a href="{{route('admin.products.addCmNsx')}}"  class="btn btn-secondary me-2">Thêm CM cho NSX</a>
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
                        {{ session('msg') }}
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
                            <label for="slugNSX" class="form-label">Đường dẫn:</label>
                            <input type="text" name="slugNSX" id="slugNSX" class="form-control" value="{{ old('slugNSX') }}" readonly style="background-color:#ccc">
                            @error('slugNSX')
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
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo:</label>
                            <input type="file" name="logo" id="logo" class="form-control" >
                            @error('logo')
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

    <!-- Bảng hiển thị danh sách nhà sản xuất -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Danh Sách Nhà Sản Xuất</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Logo</th>
                        <th>Tên Nhà Sản Xuất</th>
                        <th>Số Điện Thoại</th>
                        <th>Email</th>
                        <th>Địa Chỉ</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(getAllNSX() as $key =>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><img style="width: 100px" src="{{ asset('storage/brands/img/'.$item->logo) }}" alt=""></td>
                            <td>{{ $item->ten_NSX }}</td>
                            <td>{{ $item->so_dien_thoai }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->dia_chi }}</td>
                            <td>
                                <form action="{{ route('admin.products.deleteNsx', $item->maNSX) }}" method="POST" style="display:inline;" id="delete-form-{{$key}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-product" data-form="delete-form-{{$key}}">Xóa</button>
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
    document.querySelectorAll('.delete-product').forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const formId = event.target.getAttribute('data-form');
        const form = document.getElementById(formId);
        
        Swal.fire({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "Bạn sẽ không thể hoàn tác điều này!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
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
        const nameInput = document.getElementById('ten_NSX');
        const slugInput = document.getElementById('slugNSX');
        nameInput.addEventListener('input', function() {
            slugInput.value = generateSlug(nameInput.value);
        });
</script>
@endsection