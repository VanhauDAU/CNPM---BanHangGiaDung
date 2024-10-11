@extends('layouts.admin')

@section('title')
    Thông tin {{$productDetail->ten_san_pham}}
@endsection

@section('content-admin')
<div class="container mt-4">
    <div class="text-center mb-4">
        <a href="{{ route('admin.products.index') }}" class="btn btn-danger">Quay Lại</a>
        <a href="{{ route('admin.products.edit', ['id' => $productDetail->maSP]) }}" class="btn btn-primary ">Chỉnh Sửa Thông Tin</a>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex gap-5">
            <!-- Khung thông tin sản phẩm -->
            
            <div class="card col-md-7">
                <div class="card-header text-white text-center">
                    <h3 class="running-text m-0">THÔNG TIN SẢN PHẨM</h3>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <!-- Hình ảnh sản phẩm bên trái -->
                        <div class="col-md-5 text-center">
                            <img src="{{ asset('storage/products/img/' . $productDetail->anh) ?: 'https://via.placeholder.com/150' }}" alt="Product Image"
                                 alt="Hình ảnh sản phẩm" 
                                 class="img-thumbnail" 
                                 style="width: auto;">
                        </div>

                        <!-- Thông tin sản phẩm bên phải -->
                        <div class="col-md-7">
                            <h4 class="text-primary"><strong>{{ $productDetail->ten_san_pham }}</strong></h4>
                            <p><strong>Mã sản phẩm: </strong>{{ $productDetail->maSP }}</p>
                            <p><strong>Loại sản phẩm: </strong>{{ $productDetail->ten_danh_muc }}</p>
                            <p><strong>Giá: </strong>{{ number_format($productDetail->don_gia, 0, ',', '.') }} VNĐ</p>
                            <p><strong>Trọng lượng: </strong>{{ number_format($productDetail->trong_luong, 2) }} kg</p>
                            <p><strong>Số lượng tồn: </strong>{{ $productDetail->so_luong_nhap }}</p>
                            <p><strong>Xuất xứ: </strong>{{ $productDetail->xuat_xu }}</p>
                            
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Khung thông tin chi tiết sản phẩm -->
            <div class="card col-md-4">
                <div class="card-header text-white" style="background-color: #005AB7;">
                    <h4 class="card-title m-0">Chi tiết sản phẩm</h4>
                </div>
                <div class="card-body">
                    <p><strong>Nhà cung cấp: </strong>
                        {{ $productDetail->ten_NSX ?? 'Không xác định' }}
                    </p>
                    <p><strong>Ngày nhập kho: </strong>
                        {{$productDetail->created_at ? \Carbon\Carbon::parse($productDetail->created_at)->format('H:i:s d-m-Y') : 'Không xác định'}}
                    </p>
                    <p><strong>Ngày cập nhật gần nhất: </strong>
                        {{$productDetail->updated_at ? \Carbon\Carbon::parse($productDetail->updated_at)->format('H:i:s d-m-Y') : 'Không xác định'}}
                    </p>
                </div>
            </div>

            
        </div>
    </div>
    <div class="row">
        <p><strong>Mô tả: </strong>{!! $productDetail->mo_ta !!}</p>
    </div>
</div>
@endsection

@section('stylesheet')
<style>
    /* Định dạng lại các thẻ HTML để tạo sự nhất quán và thu hút hơn */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #005AB7;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 15px;
    }

    .btn {
        border-radius: 5px;
        padding: 10px 15px;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-primary {
        background-color: #005AB7;
        color: white;
    }

    .btn-primary:hover {
        background-color: #004494;
    }

    .text-primary {
        color: #005AB7;
    }

    .img-thumbnail {
        border: 1px solid #dee2e6;
        border-radius: 5px;
        transition: transform 0.3s ease;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    .running-text {
        animation: slide 10s linear infinite;
    }

    /* @keyframes slide {
        0% { transform: translateY(0); }
        100% { transform: translateY(-100%); }
    }

    @media (max-width: 768px) {
        .col-md-7, .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    } */

</style>
@endsection
