@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('content-clients')
    @if(!empty($productDetail->id_danh_muc))
        <div class="container mt-1" style="padding: 40px 0px 0px;">  
        @else
        <div class="container mt-1" style="padding: 56px 0px 0px;">  
        @endif
        <div class="main-products">
        {{-- đường dẫn --}}
        @if(!empty($productDetail->id_danh_muc))
        <div class="breadcrumb d-flex align-items-center">
            <a href="{{route('home.products.index')}}"><i class="fa-solid fa-house"></i></a>
            <span class="separator">></span>
            <a href="{{route('home.products.sanpham_id', $productDetail->id_danh_muc)}}" class="breadcrumb-link">{{$productDetail->ten_danh_muc}}</a>

            @if(!empty($productDetail->id_chuyen_muc) && !request()->routeIs('home.products.sanpham_id'))
                <span class="separator">></span>
                <a href="{{route('home.products.sanpham_id_id', [$productDetail->id_danh_muc, $productDetail->id_chuyen_muc])}}" class="breadcrumb-link">{{$productDetail->ten_chuyen_muc}}</a>
            @endif
        </div>
        @endif

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
                        <a href="?sort=moinhat" class="{{ request('sort') == 'moinhat' ? 'active' : '' }}">Mới nhất</a>
                    </div>
                </form>
                <div class="row">
                    @if(!empty($productList) && count($productList) > 0)
                    @foreach ($productList as $product)
                        <div class="col-6 col-md-4 col-lg-3" style="padding:0px 2px 0px ">
                            <a href="{{route('home.chi_tiet_sp',$product->maSP)}}">
                                <div class="product-item p-2 d-flex flex-column" style="border-radius: 10px; background-color: #fff; transition: transform 0.3s ease;">
                                    <div class="img-container position-relative d-flex justify-content-center align-items-center" style="min-height: 200px;width: auto;overflow: hidden; border:1px solid #ccc;border-radius:20px">
                                        <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" class="img-fluid" alt="{{ $product->ten_san_pham }}" style="object-fit: cover;padding: 8px;border-radius: 10px; width:auto">
                                        
                                        {{-- Kiểm tra trạng thái sản phẩm, nếu hết hàng thì hiển thị--}}
                                        @if($product->so_luong_ton == 0)
                                            <div class="out-of-stock-label position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 10px 0; font-weight: bold;">
                                                Sản phẩm tạm hết
                                            </div>
                                        @endif
                                        {{-- Kiểm tra trạng thái sản phẩm, nếu hết hàng thì hiển thị--}}
                                        @if($product->created_at >= \Carbon\Carbon::now()->subDays(3))
                                            <div class="new-product-label position-absolute bottom-0 end-0 text-white px-3 py-1" style="font-weight: bold;">
                                                SẢN PHẨM MỚI
                                            </div>
                                        @endif
                                        {{-- phần trăm giảm giá--}}
                                        @if(number_format((($product->don_gia_goc - $product->don_gia) / $product->don_gia_goc)*100) > 0 && $product->so_luong_ton >0)
                                            <div class="new-product-label2 position-absolute top-0 end-0 text-red px-3 py-1" style="font-weight: bold;">
                                                -{{number_format((($product->don_gia_goc - $product->don_gia) / $product->don_gia_goc)*100)}}%
                                            </div>
                                        @endif
                                    </div>
                                    <h6 class="mt-2 text-center product-name">{{ $product->ten_san_pham }}</h6>
                                    <div class="price_star d-flex justify-content-between align-items-center">
                                        <p class="text-muted text-decoration-line-through mb-1" style="font-size: 0.875rem;">{{ number_format($product->don_gia_goc, 0, ',', '.') }}đ</p>
                                        <div class="star_danhgia d-flex" style="font-size: 13px; color:orange">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <p class="text-danger fw-bold mb-1" style="font-size: 1.2rem;">{{ number_format($product->don_gia, 0, ',', '.') }}đ</p>
                                    <a href="{{route('home.chi_tiet_sp',$product->maSP)}}" class="btn mt-1 btn-xemchitiet">Mua Ngay</a>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
        body{
            /* background-size: cover; */
            background-attachment: fixed;
            margin: 0; 
        }
        main{
            padding: 10px;
            background-color: white;
            height: 100vh;
            padding-bottom: 50px
        }
        .container.detail_product{
            margin: 10px 0px 50px;
        }
        
    </style>

@endsection
