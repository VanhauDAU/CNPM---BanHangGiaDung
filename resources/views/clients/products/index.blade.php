@extends('layouts.client')
@section('title')
    {{$title}} 
    {{-- @if(!empty(request()->routeIs('home.products.sanpham_id')))
        {{ Str::upper($productDetail->ten_danh_muc) }}
    @endif --}}
    @if(request()->routeIs('home.products.sanpham_id_id'))
        {{ Str::upper($productDetail->ten_chuyen_muc) }}
    @endif
@endsection
@section('content-clients')
    @if(!empty($productDetail->id_danh_muc))
        <div class="container mt-1" style="padding: 40px 0px 0px;">  
        @else
        <div class="container mt-1" style="padding: 56px 0px 0px;">  
    @endif
        <div class="main-products px-3">
        {{-- đường dẫn --}}
        @if(!empty($productDetail))
            <div class="breadcrumb d-flex align-items-center">
                <a href="{{route('home.index')}}"><i class="fa-solid fa-house"></i></a>
                @if(Route::currentRouteName() == 'home.products.sanpham_id')
                    <span class="separator">></span>
                    <a href="{{route('home.products.sanpham_id',$productDetail->slugDm)}}" class="breadcrumb-link">{{$productDetail->ten_danh_muc}}</a>
                @elseif(Route::currentRouteName() == 'home.products.sanpham_id_id')
                    <span class="separator">></span>
                    <a href="{{route('home.products.sanpham_id',$productDetail->slugDm)}}" class="breadcrumb-link">{{$productDetail->ten_danh_muc}}</a>
                    <span class="separator">></span>
                    <a href="{{route('home.products.sanpham_id_id',[$productDetail->slugDm,$productDetail->slugCm])}}" class="breadcrumb-link">{{$productDetail->ten_chuyen_muc}}</a>
                @endif
            </div> 
        @else
            <a href="{{route('home.products.index')}}"><i class="fa-solid fa-house"></i></a>
        @endif

        <div class="row pt-1">
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
                                @foreach ($danhMucNsx as $item)
                                    <option value="{{$item->maNSX}}" {{request()->nsx == $item->maNSX ? 'selected' : false}}>{{$item->ten_NSX}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm sản phẩm" value="{{request()->keyword}}">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" >Tìm Kiếm</button>
                        </div>
                    </div>
                    <div class="row_sort mb-3 text-center quick_product gap-2 d-flex align-items-center justify-content-between">
                        <div class="sort-btn">
                            <a href="?sort=tangdan" class="{{ request('sort') == 'tangdan' ? 'active' : '' }}">Giá tăng dần</a>
                        <a href="?sort=giamdan" class="{{ request('sort') == 'giamdan' ? 'active' : '' }}">Giá giảm dần</a>
                        <a href="?sort=moinhat" class="{{ request('sort') == 'moinhat' ? 'active' : '' }}">Mới nhất</a>
                        </div>
                        @if(!empty($imgBrand))
                            {{-- {{dd($product->logo)}} --}}
                                <div class="brand-logo me-3">
                                    <img src="{{asset('storage/brands/img/'.$imgBrand->logo)}}" alt="" width="200px">
                                </div>
                        @endif
                    </div>
                </form>
                <div class="row">
                    @if(!empty($productList) && count($productList) > 0)
                    @foreach ($productList as $product)
                    {{-- {{dd($productList)}} --}}
                        <div class="col-6 col-md-4 col-lg-3" style="padding:0px 2px 0px ">
                            <a href="{{route('home.chi_tiet_sp',$product->slug)}}">
                                <div class="product-item p-2 d-flex flex-column" style="border-radius: 10px; background-color: #fff; transition: transform 0.3s ease;">
                                    <div class="img-container position-relative d-flex justify-content-center align-items-center" style="min-height: 200px;width: auto;overflow: hidden; border:1px solid #ccc;border-radius:20px">
                                        <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" class="img-fluid" alt="{{ $product->ten_san_pham }}" style="object-fit: cover;padding: 8px;border-radius: 10px;max-height: 200px;width:auto">
                                        
                                        {{-- Kiểm tra trạng thái sản phẩm, nếu hết hàng thì hiển thị--}}
                                        @if($product->so_luong_ton == 0)
                                            <div class="out-of-stock-label position-absolute top-0 start-0 bg-danger text-white px-3 py-1" style="border-radius: 0 0 10px 0; font-weight: bold;">
                                                Tạm hết hàng
                                            </div>
                                        @elseif(\Carbon\Carbon::now()->month == 10)
                                            <div class="new-product-label1 position-absolute top-0 start-0 text-white px-3 py-1" style="font-weight: bold;">
                                                CHÀO THÁNG 10
                                            </div>
                                        @endif
                                        @if(\Carbon\Carbon::now()->diffInDays($product->created_at) <= 2)
                                            <div class="new-product-label position-absolute bottom-0 end-0 text-white px-3 py-1" style="font-weight: bold;">
                                                SẢN PHẨM MỚI
                                            </div>
                                        @endif


                                        {{-- @if (\Carbon\Carbon::now()->month == 10)
                                            <div class="new-product-label1 position-absolute bottom-0 start-0 text-white px-3 py-1" style="font-weight: bold;">
                                                CHÀO THÁNG 10
                                            </div>
                                        @endif --}}

                                        {{-- phần trăm giảm giá--}}
                                        @if(number_format((($product->don_gia_goc - $product->don_gia) / $product->don_gia_goc)*100) > 0 && $product->so_luong_nhap >0)
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
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-6">
                                            <p class="text-danger fw-bold mb-1" style="font-size: 1.2rem;">{{ number_format($product->don_gia, 0, ',', '.') }}đ</p>
                                        </div>
                                        <div class="col-md-6 text-end viewProduct align-middle">
                                            <i class="fa-regular fa-eye" style="font-size: 15px"></i> 
                                            <span style="font-size: 15px">100</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if($product->so_luong_ton != 0)
                                            <form action="{{ route('home.cart.add', $product->maSP) }}" method="post" class="col-5">
                                                @csrf
                                                <input type="hidden" name="so_luong" value="1">
                                                <button type="submit" class="btn btn-primary btn-xemchitiet"><i class="fa-solid fa-cart-plus"></i></button>
                                            </form>
                                            <form action="{{ route('home.cart.add', $product->maSP) }}" method="post" class="col-7">
                                                @csrf
                                                <input type="hidden" name="so_luong" value="1">
                                                <input type="hidden" name="action" value="buy_now"> <!-- Thêm tham số này -->
                                                <button type="submit" class="btn btn-warning btn-pay">Mua Ngay</button>
                                            </form>
                                        @else
                                            <form action="{{ route('home.cart.add', $product->maSP) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-warning btn-xemchitiet-lienhe">Liên hệ</button>
                                            </form>
                                        @endif
                                    </div>
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
