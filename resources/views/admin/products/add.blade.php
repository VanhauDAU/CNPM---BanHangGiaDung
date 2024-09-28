@extends('layouts.admin')

@section('title')
    Thêm Sản Phẩm Mới
@endsection

@section('content-admin')
<div class="container">
    <div class="row justify-content-center">
        <div class=" mt-3" style="margin:10px 15px 20px 15px;display:flex; justify-content: space-between">
            <a href="{{ route('admin.manage_product') }}" class="btn btn-primary" id="btn-quay-lai" style="margin: 8px">Quay Lại</a>
            <div class="btn" style="display: flex; justify-content: center; align-items:center; gap:10px">
                <button id="btn-add-nsx" class="btn btn-primary">Thêm Nhà Sản Xuất</button>
            <button id="btn-add-danh_muc" class="btn btn-primary">Thêm Danh Mục</button>
            </div>
        </div>
        <div class="col-md-10" style="width: 100%" id="form-san-pham">
            <div class="panel panel-default">
                <div class="panel-heading bg-primary text-white text-center">
                    <h3 class="panel-title">THÊM SẢN PHẨM MỚI</h3>
                </div>
                <div class="panel-body">
                    <!-- Form thêm sản phẩm -->
                    <form action="{{ route('admin.store_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger text-center" id="error-message">
                                Vui lòng kiểm tra lại dữ liệu
                            </div>
                        @endif

                        @if(session('msg'))
                            <div class="alert alert-success"  id="success-message">
                                {{session('msg')}}
                            </div>
                        @endif
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maSP">Mã sản phẩm:</label>
                                    <input type="text" name="maSP" id="maSP" class="form-control" value="{{old('maSP')}}">
                                    @error('maSP')
                                            <span style="color:red;">{{$message}}</span>
                                    @enderror   
                                </div>
                                
                                <div class="form-group">
                                    <label for="maNSX">Nhà sản xuất:</label>
                                    <select name="maNSX" id="maNSX" class="form-control">
                                        <option value="">Chọn nhà sản xuất</option>
                                        @if(!empty(getAllNSX()))
                                            @foreach(getAllNSX() as $item)
                                                <option value="{{ $item->maNSX }}" {{ old('maNSX') == $item->maNSX ? 'selected' : '' }}>{{ $item->ten_NSX }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('maNSX')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="nhomSP">Loại sản phẩm:</label>
                                    <select name="nhomSP" id="nhomSP" class="form-control">
                                        <option value="">Chọn loại sản phẩm</option>
                                        @if(!empty(getAllDanhMucSp()))
                                            @foreach(getAllDanhMucSp() as $item)
                                                <option value="{{ $item->nhomSP }}" {{ old('nhomSP') == $item->nhomSP ? 'selected' : '' }}>{{ $item->ten_nhom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('nhomSP')
                                        <span style="color:red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                

                                <div class="form-group">
                                    <label for="don_gia">Giá (VNĐ):</label>
                                    <input type="number" name="don_gia" id="don_gia" class="form-control" value="{{old('don_gia')}}">
                                    @error('don_gia')
                                            <span style="color:red;">{{$message}}</span>
                                    @enderror   
                                </div>
                                <div class="form-group">
                                    <label for="hinh_anh">Hình ảnh sản phẩm:</label>
                                    <input type="file" name="hinh_anh" id="hinh_anh" class="form-control" accept="image/*" value="{{old('hinh_anh')}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ten_san_pham">Tên sản phẩm:</label>
                                    <input type="text" name="ten_san_pham" id="ten_san_pham" class="form-control" value="{{old('ten_san_pham')}}">
                                    @error('ten_san_pham')
                                            <span style="color:red;">{{$message}}</span>
                                    @enderror   
                                </div>
                                
                                <div class="form-group">
                                    <label for="so_luong_ton">Số lượng nhập:</label>
                                    <input type="number" name="so_luong_ton" id="so_luong_ton" class="form-control" value="{{old('so_luong_ton')}}">
                                </div>
                                <div class="form-group">
                                    <label for="trong_luong">Trọng lượng:</label>
                                    <input type="number" name="trong_luong" id="trong_luong" class="form-control" value="{{old('trong_luong')}}">
                                </div>
                                <div class="form-group">
                                    <label for="mo_ta">Mô tả sản phẩm:</label>
                                    <textarea name="mo_ta" id="mo_ta" class="form-control" rows="5" value="{{old('mo_ta')}}"></textarea>
                                </div>
                            </div>
                            
                            
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Thêm sản phẩm</button>
                    </form>
                </div>
            </div>            
        </div>
        <!-- Form Thêm Nhà Sản Xuất -->
        <div id="form-nsx" class="col-md-10" style="width: 100%; display:none">
            <div class="panel panel-default">
                <div class="panel-heading bg-primary text-white text-center">
                    <h3 class="panel-title">THÊM NHÀ SẢN XUẤT</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="POST">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger text-center">
                                Vui lòng kiểm tra lại dữ liệu
                            </div>
                        @endif
                        @if(session('msg'))
                            <div class="alert alert-success">
                                {{session('msg')}}
                            </div>
                        @endif

                        <!-- Các trường thêm nhà sản xuất -->
                        <div class="form-group">
                            <label for="maNSX">Mã nhà sản xuất:</label>
                            <input type="text" name="maNSX" id="maNSX" class="form-control" value="{{old('maNSX')}}">
                            @error('maNSX')
                                    <span style="color:red;">{{$message}}</span>
                            @enderror  
                        </div>
                        <div class="form-group">
                            <label for="ten_NSX">Tên nhà sản xuất:</label>
                            <input type="text" name="ten_NSX" id="ten_NSX" class="form-control" value="{{old('ten_NSX')}}">
                            @error('ten_NSX')
                                    <span style="color:red;">{{$message}}</span>
                            @enderror  
                        </div>
                        <div class="form-group">
                            <label for="dia_chi">Địa chỉ:</label>
                            <input type="text" name="dia_chi" id="dia_chi" class="form-control" value="{{old('dia_chi')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                            @error('email')
                                    <span style="color:red;">{{$message}}</span>
                            @enderror  
                        </div>
                        <div class="form-group">
                            <label for="so_dien_thoai">Số điện thoại:</label>
                            <input type="text" name="so_dien_thoai" id="so_dien_thoai" class="form-control" value="{{old('so_dien_thoai')}}">
                            @error('so_dien_thoai')
                                    <span style="color:red;">{{$message}}</span>
                            @enderror  
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Thêm nhà sản xuất</button>
                    </form>
                </div>
            </div>
            <button id="btn-close-nsx" class="btn btn-danger">Đóng</button>
        </div>
    </div>
</div>
<!-- Modal để thêm nhà sản xuất -->
@endsection
