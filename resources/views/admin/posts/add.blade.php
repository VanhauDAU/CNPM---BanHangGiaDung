@extends('layouts.admin')

@section('title')
    Thêm Bài Viết
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('admin.manage_post') }}" class="btn btn-primary">Quay Lại</a>
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
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="tieu_de" class="form-label col-md-12">Tiêu đề:</label>
                        <input type="text" class="form-control" name="tieu_de" id="tieu_de" placeholder="Tiêu đề...." value="{{old('tieu_de')}}">
                        @error('tieu_de')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="slug" class="form-label col-md-12">Đường dẫn:</label>
                        <input type="text" class="form-control" name="slug" id="slug" readonly style="background-color:#ccc" value="{{olde('slug')}}">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="anh_bia" class="form-label col-md-12">Ảnh bìa:</label>
                        <input type="file" class="form-control" name="anh_bia" id="anh_bia">
                        @error('anh_bia')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <label for="noi_dung" class="form-label col-md-12">Mô tả sản phẩm:</label>
                    <div class="col-md-12"> <!-- Thêm div col-md-12 -->
                        <textarea name="noi_dung" id="noi_dung" class="form-control" rows="5" placeholder="Mô tả sản phẩm">{{ old('noi_dung') }}</textarea>
                        @error('noi_dung')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#noi_dung'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                </div>

                <button type="submit" class="btn btn-success w-100">Thêm bài viết</button>
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
        const nameInput = document.getElementById('tieu_de');
        const slugInput = document.getElementById('slug');
        nameInput.addEventListener('input', function() {
            slugInput.value = generateSlug(nameInput.value);
        });
    </script>
@endsection
