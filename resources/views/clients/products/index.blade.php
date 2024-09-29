@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content-clients')
  <div class="container mt-1" style="padding: 90px 0px;">
    <div class="row">
        @include('clients.blocks.categories')
        <!-- Danh sách sản phẩm -->
        <div class="col-md-9 product-list">
            <h5>Các Sản Phẩm <span style="color:red">[{{count($productList)}} sp]</span></h5>
            <!-- Hàng bộ lọc -->
            <form action="" method="get">
                <div class="row mb-2">
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
                <div class="row_sort mb-3 text-center quick_product gap-2">
                    <a href="?sort=tangdan" class="{{ request('sort') == 'tangdan' ? 'active' : '' }}">Giá tăng dần</a>
                    <a href="?sort=giamdan" class="{{ request('sort') == 'giamdan' ? 'active' : '' }}">Giá giảm dần</a>
                    <a href="?sort=giamdan" class="{{ request('sort') == 'giamgia' ? 'active' : '' }}">Giảm giá</a>
                    <a href="?sort=giamdan" class="{{ request('sort') == 'moinhat' ? 'active' : '' }}">Mới nhất</a>
                    <a href="?sort=banchay" class="{{ request('sort') == 'banchay' ? 'active' : '' }}">Bán chạy nhất</a>
                </div>
            </form>
            <div class="row">
                @if(!empty($productList) && count($productList) > 0)
                @foreach ($productList as $product)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <a href="{{route('home.chi_tiet_sp',$product->maSP)}}">
                            <div class="product-item border p-3 d-flex flex-column" style="min-height: 400px; border-radius: 10px; background-color: #fff; transition: transform 0.3s ease;">
                                <div class="img-container position-relative text-center" style="height: 200px; overflow: hidden; border:1px solid #ccc;border-radius:20px">
                                    <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" class="img-fluid" alt="{{ $product->ten_san_pham }}" style="object-fit: cover; border-radius: 10px;">
                                    
                                    {{-- Kiểm tra trạng thái sản phẩm, nếu hết hàng thì hiển thị miếng màu đỏ --}}
                                    @if($product->so_luong_ton == 0)
                                        <div class="out-of-stock-label position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 10px 0; font-weight: bold;">
                                            Hết hàng
                                        </div>
                                    @endif
                                </div>
                                <h6 class="mt-2 text-center product-name">{{ $product->ten_san_pham }}</h6>
                                <p class="text-muted text-decoration-line-through mb-1" style="font-size: 0.875rem;">{{ number_format($product->don_gia_goc, 0, ',', '.') }}đ</p>
                                <p class="text-danger fw-bold mb-1" style="font-size: 1.2rem;">{{ number_format($product->don_gia, 0, ',', '.') }}đ</p>
                                <a href="{{route('home.chi_tiet_sp',$product->maSP)}}" class="btn btn-outline-primary mt-auto">Xem Chi Tiết</a>
                            </div>
                        </a>
                    </div>
                @endforeach
                {{ $productList->links() }}
            @else
                <div class="col-12 text-center">
                    <h2>Không có sản phẩm nào!</h2>
                </div>
            @endif

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
        
        
    </style>

@endsection
