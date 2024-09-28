@extends('layouts.admin')

@section('title')
    Thông tin {{$productDetail->ten_san_pham}}
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12" style="margin-top: 50px;">
            <div class="panel panel-default">
                <div class="panel-heading bg-primary text-white text-center">
                    <h3 class="panel-title running-text">THÔNG TIN SẢN PHẨM</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ $productDetail->anh ?? 'https://via.placeholder.com/150' }}" alt="Hình ảnh sản phẩm" class="img-thumbnail" style="width: 200px; height: 200px;">
                        </div>
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
            <div class="panel panel-default mt-3">
                <div class="panel-heading bg-info text-white">
                    <h4 class="panel-title">Chi tiết sản phẩm</h4>
                </div>
                <div class="panel-body">
                    <p><strong>Nhà cung cấp: </strong>
                        @if(!empty($productDetail->ten_NSX))
                            {{ $productDetail->ten_NSX }}
                        @else
                            Không xác định
                        @endif
                    </p>
                    <p><strong>Ngày nhập kho: </strong>{{ \Carbon\Carbon::parse($productDetail->created_at)->format('d-m-Y H:i:s') }}</p>
                    <p><strong>Ngày cập nhật gần nhất: </strong>
                        @if(!empty($productDetail->updated_at))
                            {{ \Carbon\Carbon::parse($productDetail->updated_at)->format('d-m-Y H:i:s') }}
                        @else
                            Không xác định
                        @endif
                    </p>
                </div>
                
            </div>

            <!-- Nút chỉnh sửa thông tin -->
            <div class="text-center mt-3">
                <a href="{{ route('getedit_product', ['id' => $productDetail->maSP]) }}" class="btn btn-primary btn-sm">Chỉnh Sửa Thông Tin</a>
                <a href="{{route('admin.manage_product')}}" class="btn btn-danger btn-sm">Quay Lại</a>
            </div>
        </div>
    </div>
</div>
@endsection
