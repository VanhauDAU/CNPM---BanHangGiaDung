@extends('layouts.admin')

@section('title')
    Thông tin {{$productDetail->ten_san_pham}}
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 d-flex gap-5">
            <!-- Khung thông tin sản phẩm -->
            <div class="card col-md-7">
                <div class="card-header text-white text-center">
                    <h3 class="card-title running-text m-0">THÔNG TIN SẢN PHẨM</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Hình ảnh sản phẩm bên trái -->
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('storage/products/img/' . $productDetail->anh) ?: 'https://via.placeholder.com/150' }}" alt="Product Image"
                                 alt="Hình ảnh sản phẩm" 
                                 class="img-thumbnail shadow" 
                                 style="width: 200px; height: 200px;">
                        </div>

                        <!-- Thông tin sản phẩm bên phải -->
                        <div class="col-md-8">
                            <h4 class="text-primary"><strong>{{ $productDetail->ten_san_pham }}</strong></h4>
                            <p><strong>Mã sản phẩm: </strong>{{ $productDetail->maSP }}</p>
                            <p><strong>Loại sản phẩm: </strong>{{ $productDetail->ten_nhom }}</p>
                            <p><strong>Giá: </strong>{{ number_format($productDetail->don_gia, 0, ',', '.') }} VNĐ</p>
                            <p><strong>Trọng lượng: </strong>{{ number_format($productDetail->trong_luong, 2) }} kg</p>
                            <p><strong>Số lượng tồn: </strong>{{ $productDetail->so_luong_ton }}</p>
                            <p><strong>Mô tả: </strong>{{ $productDetail->mo_ta }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Khung thông tin chi tiết sản phẩm -->
            <div class="card mt-3 col-md-4">
                <div class="card-header text-white" style="background-color: #005AB7;">
                    <h4 class="card-title m-0">Chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nhà cung cấp: </strong>
                        {{ $productDetail->ten_NSX ?? 'Không xác định' }}
                    </p>
                    <p><strong>Ngày nhập kho: </strong>{{
                        $productDetail->created_at ? \Carbon\Carbon::parse($productDetail->created_at)->format('d-m-Y H:i:s') : 'Không xác định'
                     }}</p>
                    <p><strong>Ngày cập nhật gần nhất: </strong>
                        {{ $productDetail->updated_at ? \Carbon\Carbon::parse($productDetail->updated_at)->format('d-m-Y H:i:s') : 'Không xác định' }}
                    </p>
                </div>
            </div>

            <!-- Nút chỉnh sửa thông tin -->
            
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('getedit_product', ['id' => $productDetail->maSP]) }}" class="btn btn-primary btn-sm">Chỉnh Sửa Thông Tin</a>
            <a href="{{ route('admin.manage_product') }}" class="btn btn-danger btn-sm">Quay Lại</a>
        </div>
    </div>
</div>
@endsection
