@extends('layouts.admin')

@section('title')
    Thêm Sản Phẩm Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Quay Lại</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.products.addProduct') }}" class="btn btn-danger me-2">Thêm sản phẩm</a>
            <a href="{{route('admin.products.addNsx')}}"  class="btn btn-secondary me-2">Thêm Nhà Sản Xuất</a>
            <a href="{{route('admin.products.addDm')}}"  class="btn btn-secondary me-2">Thêm Danh Mục</a>
            <a href="{{route('admin.products.addCm')}}"  class="btn btn-secondary me-2">Thêm Chuyên Mục</a>
            <a href="{{route('admin.products.addCmNsx')}}"  class="btn btn-secondary me-2">Thêm CM cho NSX</a>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{-- route('admin.store_product') --}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger text-center" id="error-message">
                        {{-- @foreach($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach --}}
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
                            <label for="maNSX" class="form-label">Nhà sản xuất:</label>
                            <select name="maNSX" id="maNSX" class="form-select" onchange="fetchDanhMuc(this.value)">
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

                        <div class="row">
                            <div class="mb-3">
                                <label for="id_danh_muc" class="form-label">Danh mục sản phẩm:</label>
                                <select name="id_danh_muc" id="id_danh_muc" class="form-select" onchange="fetchChuyenMuc(this.value)">
                                    <option value="">Chọn danh mục sản phẩm</option>
                                </select>
                                @error('id_danh_muc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="id_chuyen_muc" class="form-label">Chọn chuyên mục:</label>
                                <select name="id_chuyen_muc" id="id_chuyen_muc" class="form-select">
                                    <option value="">Chọn chuyên mục sản phẩm</option>
                                </select>
                                @error('id_chuyen_muc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <script>
                        </script>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="don_gia_goc" class="form-label">Giá Gốc (VNĐ):</label>
                                <input type="number" name="don_gia_goc" id="don_gia_goc" class="form-control" value="{{ old('don_gia_goc') }}">
                                @error('don_gia_goc')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="don_gia" class="form-label">Giá bán(VNĐ):</label>
                                <input type="number" name="don_gia" id="don_gia" class="form-control" value="{{ old('don_gia') }}">
                                @error('don_gia')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="hinh_anh" class="form-label">Hình ảnh sản phẩm:</label>
                            <input type="file" name="hinh_anh[]" id="hinh_anh" class="form-control" accept="image/*" multiple onchange="previewImages(event)">
                            @error('hinh_anh')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div id="imagePreview" class="d-flex gap-2 my-2"></div>
                        
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
                            <label for="slug" class="form-label"></label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Đường dẫn..." readonly style="background-color: #ccc">
                        </div>

                        <div class="mb-3">
                            <label for="so_luong_nhap" class="form-label">Số lượng nhập:</label>
                            <input type="number" name="so_luong_nhap" id="so_luong_nhap" class="form-control" value="{{ old('so_luong_nhap') }}">
                            <input type="hidden" value="" id="so_luong_ton" name="so_luong_ton">
                            @error('so_luong_nhap')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="trong_luong" class="form-label">Trọng lượng (Kg):</label>
                            <input type="number" name="trong_luong" id="trong_luong" class="form-control" value="{{ old('trong_luong') }}">
                            @error('trong_luong')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="sp_noi_bat" class="form-label">Loại sản phẩm</label>
                            <select name="sp_noi_bat" id="sp_noi_bat" class="form-select">
                                <option value="0" {{ old('sp_noi_bat') ==0  ? 'selected' : '' }}>Thường</option>
                                <option value="1" {{ old('sp_noi_bat') == 1 ? 'selected' : '' }}>Nổi Bật</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="xuat_xu" class="form-label">Xuất xứ:</label>
                            <select name="xuat_xu" id="xuat_xu" class="form-select">
                                <option value="">-- Chọn quốc gia --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="mo_ta" class="form-label">Mô tả sản phẩm:</label>
                            <textarea name="mo_ta" id="mo_ta" class="form-control" rows="4">{{ old('mo_ta') }}</textarea>

                            @error('mo_ta')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#mo_ta'))
                                    .catch(error => {
                                        console.error(error);
                                    });
                                // CKEDITOR.replace('mo_ta');
                            </script>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Thêm sản phẩm</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('stylesheet')
    <style>
        img{
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('js')
<script>
    
    // Lấy các input theo ID
    const numberInput = document.getElementById('so_luong_nhap');
    const textInput = document.getElementById('so_luong_ton');
    numberInput.addEventListener('input', function() {
        textInput.value = numberInput.value;
    });
    async function fetchCountries() {
        try {
            const response = await fetch('https://restcountries.com/v3.1/all');
            const countries = await response.json();
            
            const select = document.getElementById('xuat_xu');
            countries.forEach(country => {
                const option = document.createElement('option');
                option.value = country.cca2;
                option.textContent = country.name.common;
                select.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching countries:', error);
        }
    }

    // Gọi hàm để thực hiện
    fetchCountries();
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
    const nameInput = document.getElementById('ten_san_pham');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', function() {
        slugInput.value = generateSlug(nameInput.value);
    });
</script>

@endsection
