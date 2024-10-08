@extends('layouts.client')
@section('title')
    {{$title}}
@endsection
@section('sidebar')
  {{-- @parent --}}
  <h3>Home Sidebar</h3>
@endsection
@section('content-clients')
  <!-- Hero Section -->
    <div class="main-home mt-5">
        <main class="container my-1">
            <!-- Danh mục sản phẩm -->
            <section class="category-section py-1">
                <div class="container">
                    <div class="row">
                        @include('clients.blocks.categories')
                        <!-- Hình ảnh sản phẩm -->
                        <div class="col-lg-9 p-3 rounded" style="background:#DEEFE7;">
                            <div class="row d-flex justify-content-start flex-wrap mb-3">
                                @if(!empty($posts))
                                @foreach($posts as $post)
                                    <!-- Ảnh sản phẩm -->
                                    <a href="{{route('home.get_bai_viet',$post->slug)}}" class="image-link col-md-6">
                                        <div class="image-container">
                                            <img class="img-fluid fixed-size rounded mb-4" style="max-height: 150px" src="{{$post->anh_bia ? 'storage/posts/img/'.$post->anh_bia :'https://www.fivebranches.edu/wp-content/uploads/2021/08/default-image.jpg'}}" alt="Image {{$loop->index + 1}}">
                                            <div class="overlay">
                                                <h5 class="overlay-text">{{$post->tieu_de}}</h5>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                @endif
                            </div>
                            <div class="row" style="margin-top: -30px">
                                <div class="product-list-home text-center">
                                    @if(!empty($allProduct))
                                        @foreach($allProduct as $item)
                                            <a href="{{route('home.chi_tiet_sp',$item->slug)}}">
                                                <div class="product-item-home" >
                                                    <img src="{{asset('storage/products/img/'.$item->anh)}}" alt="{{$item->ten_san_pham}}"class="rounded">
                                                    <h4 class="name-product">{{\Illuminate\Support\Str::limit($item->ten_san_pham, 30)}}</h4>
                                                    <div class="price d-flex align-items-center justify-content-between">
                                                        <h6 class="price-product"><s>{{number_format($item->don_gia_goc)}}đ</s></h6>
                                                        <h4 class="price-sale-product">{{number_format($item->don_gia)}}đ</h4>
                                                    </div>
                                                </div>
                                                <div class="branch-onproduct">
                                                    {{$item->ten_NSX}}
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SẢN PHẨM NỔI BẬT --}}
            </section>
            {{-- SẢN PHẨM NỔI BẬT --}}
            <div class="row mt-3">
                <div class="col-lg-12" id="featured-products">
                    <!-- Featured Products -->
                    <h5 class="mb-4 running-text text-center text-uppercase wow animate__animated animate__fadeInDown" data-wow-delay="0.5s" data-wow-duration="1.5s" data-wow-iteration="1">
                        <span class="icon-effect"><i class="fas fa-star"></i></span>
                        Sản Phẩm Nổi Bật
                        <span class="icon-effect"><i class="fas fa-star"></i></span>
                    </h5>
                    
                    <div class="row list-product-hot my-4 justify-content-center p-3" style="background: #F29F05;border-radius: 20px">
                        @if(!empty(sanphamnoibat()))
                            @foreach (sanphamnoibat() as $product)
                                <div class="col-6 col-md-4 col-lg-2 gap-1">
                                    <a href="{{route('home.chi_tiet_sp',$product->slug)}}" class="product-link text-decoration-none">
                                        <div class="product-item shadow-sm p-3" 
                                             style="border-radius: 10px; transition: transform 0.3s ease; background-color: #f8f9fa; 
                                             height: 100%; position: relative; overflow: hidden;">
                                            {{-- @if($product->khuyen_mai) <!-- Kiểm tra xem có khuyến mãi hay không -->
                                                <span class="badge bg-danger position-absolute" style="top: 10px; left: 10px; z-index: 10;">Khuyến Mãi</span>
                                            @endif --}}
                                            
                                            <div class="img-container text-center mb-3" style="overflow: hidden; width: 100%; display: flex; justify-content: center; align-items: center;">
                                                <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" 
                                                     class="img-fluid" 
                                                     alt="{{ $product->ten_san_pham }}" 
                                                     style="border-radius: 10px; width: auto; max-width: 100%; max-height: 100px; object-fit: contain; transition: transform 0.3s;">
                                            </div>
                                            
                    
                                            <h6 class="text-center text-truncate" style="min-height: 40px; overflow: hidden; 
                                                 text-overflow: ellipsis; white-space: nowrap;">{{ $product->ten_san_pham }}</h6>
                                                 
                                            <div class="text-center">
                                                @if($product->don_gia_goc)
                                                    <p class="text-muted text-decoration-line-through mb-1" style="font-size: 0.875rem;">
                                                        {{ number_format($product->don_gia_goc, 0, ',', '.') }}đ
                                                    </p>
                                                @endif
                                                <p class="text-danger fw-bold mb-1" style="font-size: 1.1rem;">
                                                    {{ number_format($product->don_gia, 0, ',', '.') }}đ
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            {{-- <div class="row">
                                <div style="display: flex; justify-content: center; height: 20px; font-size: 20px;">
                                    {{$productList->links()}}
                                </div> 
                            </div> --}}
                        @endif
                    </div>
                </div>
            </div>
            {{-- DANH MỤC HOT --}}
            <div class="row py-4 text-center bg-white mb-4 rounded" >
                <h3 class="py-3 text-danhmuchot wow animate__animated animate__fadeInLeft ">
                    DANH MỤC HOT TẠI SHOP
                </h3>                
                <div class="row ListDanhMucHot py-3 pt-3 text-center">
                    @if(!empty(getAllDanhMucSp1()))
                        @foreach(getAllDanhMucSp1() as $item)
                        <a href="{{route('home.products.sanpham_id',$item->slug)}}">
                            <div class="Danhmuc-item text-center d-flex p-3 align-items-center" style="width: 300px;min-height: 130px; border-radius: 20px; background-color:#FFD154">
                                <img src="{{$item->icon}}" alt="" width="80px">
                                <h5 class="ms-3 fw-bold" style="color: #002795">{{$item->ten_danh_muc}}</h5>
                            </div>
                        </a>
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- DANH SÁCH SẢN PHẨM CỦA DANH MỤC ĐÓ (GIỚI HẠN 5 DANH MỤC ĐẦU) --}}
            @if(!empty(get5DanhMuc()))
                @foreach(get5DanhMuc() as $itemDm)
                    <div class="row bg-white p-3 my-3 rounded slider-container">
                        <div class="row d-flex justify-content-between my-2">
                            <h5 class="fw-bold col-4 wow animate__animated animate__jackInTheBox">Sản phẩm {{$itemDm->ten_danh_muc}}  <i class="fa-brands fa-firefox-browser" style="color: red"></i></h5>
                            <a href="{{route('home.products.sanpham_id',$itemDm->slug)}}" class="btn col-2 text-white" style="background-color: orange;margin-right: -25px">Xem tất cả sản phẩm</a>
                        </div>
                        @if(!empty(getProductDm($itemDm->id_danh_muc)))
                            <div class="product-list-danhmuc d-flex slider" data-current-slide="0">
                                @foreach(getProductDm($itemDm->id_danh_muc) as $itemProductDM)
                                    <div class="product-item-danhmuc border rounded p-2 col-2">
                                        <a href="{{route('home.chi_tiet_sp',$itemProductDM->slug)}}">
                                            <div class="img-product-danhmuc text-center p-1" style="width:100%; min-height: 170px">
                                                <img src="{{asset('storage/products/img/'.$itemProductDM->anh)}}" loading="lazy" alt="" style="width: 100%">
                                            </div>
                                            <h6 class="title-product-danhmuc" style="font-size: 13px">
                                                {{ \Illuminate\Support\Str::limit($itemProductDM->ten_san_pham, 45) }}
                                            </h6>
                                            <h6 class="brand-products-danhmuc" style="color:green">{{$itemProductDM->ten_NSX}}</h6>
                                            <div class="row price-product-danhmuc">
                                                <h6 style="color:red; font-size: 14px; font-weight: 700; margin: 0;display:flex; justify-content: space-between; min-height: 18px">
                                                    <s style="color: black; font-size: 12px">{{number_format($itemProductDM->don_gia_goc)}}đ</s>{{number_format($itemProductDM->don_gia)}}đ
                                                </h6>
                                                <div class="list-star mt-2" style="font-size: 14px; display: flex; color:orange">
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                    <i class="fa-solid fa-star"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>   
                                @endforeach
                            </div>
                            <button class="prev">❮</button>
                            <button class="next">❯</button>   
                        @endif     
                    </div>
                @endforeach
            @endif
            {{-- DANH SÁCH NHÃN HÀNG --}}
            <div class="listBrand">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="row">
                        <h5 style="padding: 10px; margin-left: 10px; display:inline; background-color:#DA251C;color:white; font-weight: 600;font-size:30px" class=" text-center rounded">THƯƠNG HIỆU HỢP TÁC</h5>
                    </div>
                    @if(!empty($brand))
                    @foreach($brand as $item)
                            <div class="col-2 d-flex align-items-center item-brand" style="min-height: 90px">
                                <a href="{{ route('home.getBrand',$item->slug)}}">
                                    <img src="{{asset('storage/brands/img/'.$item->logo)}}" alt="" style="width: 170px;padding:15px;">
                                </a>
                            </div>
                        
                    @endforeach
                @endif
                </div>
            </div>


            {{-- <div class="header-top">
                <img src="https://st.meta.vn/img/thumb.ashx/Data/2024/Thang03/dien-may/Banner-dien-may-1236x60.png" alt="" width="100%">
            </div> --}}
            <section class="product_poli_wrap mt-1 mb-3 rounded">
                <div class="container">
                    <div class="product_poli m-0">
                        <div class="row">
                            <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                                <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                                    <div class="mr-2 mr-sm-3 w-32">
                                        <picture class="position-relative w-100 m-0 ratio1by1 d-block aspect">
                                            <img src="//bizweb.dktcdn.net/thumb/icon/100/489/006/themes/949658/assets/img_poli_1.png?1727755960909" alt="" decoding="async">
                                        </picture>
                                    </div>
                                    <div class="media-body"> 
                                        <b>FREESHIP </b>cho đơn hàng từ 1.000.000đ
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 mb-3 mb-lg-0">
                                <div class="item d-flex align-items-center p-xl-3 bg-white modal-open h-100">
                                    <div class="mr-2 mr-sm-3 w-32">
                                        <picture class="position-relative w-100 m-0 ratio1by1 d-block aspect">
                                            <img src="//bizweb.dktcdn.net/thumb/icon/100/489/006/themes/949658/assets/img_poli_2.png?1727755960909" alt="" decoding="async">
                                        </picture>
                                    </div>
                                    <div class="media-body"> 
                                        Hỗ trợ giao 4h nội thành Đà Nẵng theo nhu cầu
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 ">
                                <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                                    <div class="mr-2 mr-sm-3 w-32">
                                        <picture class="position-relative w-100 m-0 ratio1by1 d-block aspect">
                                            <img src="//bizweb.dktcdn.net/thumb/icon/100/489/006/themes/949658/assets/img_poli_3.png?1727755960909" alt="" decoding="async">
                                        </picture>
                                    </div>
                                    <div class="media-body"> 
                                        Đổi trả trong 30 ngày
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 ">
                                <div class="item d-flex align-items-center p-2 p-xl-3 bg-white rounded-10 modal-open h-100 ">
                                    <div class="mr-2 mr-sm-3 w-32">
                                        <picture class="position-relative w-100 m-0 ratio1by1 d-block aspect">
                                            <img src="//bizweb.dktcdn.net/thumb/icon/100/489/006/themes/949658/assets/img_poli_4.png?1727755960909" alt="" decoding="async">
                                        </picture>
                                    </div>
                                    <div class="media-body"> 
                                        NHẬP MÃ 🏷️<b>VANHAUDAU</b> Giảm 10% cho đơn hàng ≥ 800,000₫ 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        </section>
        <section class="bg-light py-5">
          <div class="container">
              <h2 class="text-center mb-5">Khuyến Mãi</h2>
              <div class="row g-4">
                  <div class="col-md-6">
                      <div class="p-4 bg-white shadow-sm h-100">
                          <h4>Giảm Giá 10% Cho Các Đơn Hàng Trên 1 Triệu</h4>
                          <p>Mua sắm ngay và nhận ngay ưu đãi hấp dẫn!</p>
                          <a href="#" class="btn btn-primary">Chi Tiết</a>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="p-4 bg-white shadow-sm h-100">
                          <h4>Mua 1 Tặng 1</h4>
                          <p>Áp dụng cho các sản phẩm quạt và máy xay sinh tố.</p>
                          <a href="#" class="btn btn-primary">Chi Tiết</a>
                      </div>
                  </div>
              </div>
          </div>
        </section>
        
@endsection
{{-- js --}}
@section('js')
<script>
    document.getElementById('scroll-to-products').addEventListener('click', function(e) {
        e.preventDefault(); 
        document.getElementById('featured-products').scrollIntoView({
            behavior: 'smooth'
        });
    });
    document.querySelectorAll('.image-container').forEach(item => {
        item.addEventListener('mouseover', event => {
            item.querySelector('img').style.transform = 'scale(1.1)'; 
        });

        item.addEventListener('mouseout', event => {
            item.querySelector('img').style.transform = 'scale(1)'; 
        });
    });
    // Get modal element
    const modal = document.getElementById("popupModal");
    const closeBtn = document.querySelector(".close-btn");

    window.onload = function() {
        modal.style.display = "flex";
    }
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    $('.product-list-home').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        Accessibility: true
    });
    

</script>
@endsection