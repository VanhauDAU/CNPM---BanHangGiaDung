@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content-clients')
  <div class="container mt-2" style="padding: 100px 0px;">
    <div class="row">
        <!-- Danh mục sản phẩm -->
        <div class="col-md-3 category">
            <h5>Danh Mục Sản Phẩm</h5>
            <ul class="list-group">
                @if(!empty(getAllDanhMucSp()))
                @foreach (getAllDanhMucSp() as $item)
                <li class="list-group-item">
                    <a href="#">{{$item->ten_nhom}}</a>
                </li>
                @endforeach
                @endif
            </ul>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-md-9 product-list">
            <h5>Các Sản Phẩm</h5>
            <!-- Hàng bộ lọc -->
            <form action="" method="get">
                <div class="row mb-4">
                    <div class="col-sm-1">
                        <label for="keyword" class="d-flex align-items-center">
                            <i class="fa-solid fa-filter" style="font-size:20px; margin-right: 10px;"></i>
                            <h4 class="mb-0 fs-6">Bộ Lọc</h4>
                        </label>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" name="nsx" value="{{request()->nsx}}">
                            <option value="">Chọn Nhà Sản Xuất</option>
                            @if(!empty(getAllNSX()))
                            @foreach (getAllNSX() as $item)
                            <option value="{{$item->maNSX}}" {{request()->nsx == $item->maNSX ? 'selected' : false}}>{{$item->ten_NSX}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sản phẩm" value="{{request()->keyword}}">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary">Tìm Kiếm</button>
                    </div>
                </div>
            </form>
            <div class="row">
                @foreach ($productList as $product)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="product-item border p-3 d-flex flex-column" style="min-height: 430px; border-radius: 10px">
                            <div class="img-container">
                                <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" class="img-fluid" alt="{{ $product->ten_san_pham }}" >
                            </div>
                            <h6 class="mt-2" style="min-height: 80px">{{ $product->ten_san_pham }}</h6>
                            <p class="text-muted text-decoration-line-through" style="margin-bottom: 2px">{{ number_format($product->don_gia_goc, 0, ',', '.') }}đ</p>
                            <p class="text-danger fw-bold" style="font-size: 1.25rem;">{{ number_format($product->don_gia, 0, ',', '.') }}đ</p>
                            <a href="#" class="btn btn-primary mt-auto">Xem Chi Tiết</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div style="display: flex; justify-content: center; height: 20px; font-size: 20px;">
                    {{$productList->links()}}
                </div> 
            </div>
                    
        </div>
    </div>
</div>
@endsection

@section('stylesheet')
    <style>
        .product-item {
            transition: transform 0.2s;
        }

        .img-container {
            overflow: hidden; 
            position: relative;
        }

        .img-container img {
            transition: transform 0.2s;
        }

        .product-item:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .product-item:hover .img-container img {
            transform: scale(1.1);
        }

    </style>

@endsection
