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
                                <div class="col-12 text-center">
                                    <p>Xin chào, đây là danh sách sản phẩm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SẢN PHẨM NỔI BẬT --}}
            </section>
            <div class="row mt-4">
                <div class="col-lg-12" id="featured-products">
                    <!-- Featured Products -->
                    <h5 class="mb-4 running-text text-center text-uppercase">
                        <span class="icon-effect"><i class="fas fa-star"></i></span>
                        Sản Phẩm Nổi Bật
                        <span class="icon-effect"><i class="fas fa-star"></i></span>
                    </h5>
                    <div class="row my-4 justify-content-center p-3 rounded" style="background: #F29F05">
                        @if(!empty(sanphamnoibat()))
                            @foreach (sanphamnoibat() as $product)
                                <div class="col-6 col-md-4 col-lg-2 mb-3 gap-1">
                                    <a href="{{route('home.chi_tiet_sp',$product->slug)}}" class="product-link text-decoration-none">
                                        <div class="product-item shadow-sm p-3 d-flex flex-column" 
                                             style="border-radius: 10px; transition: transform 0.3s ease; background-color: #f8f9fa; 
                                             height: 100%; position: relative; overflow: hidden;">
                    
                                            {{-- @if($product->khuyen_mai) <!-- Kiểm tra xem có khuyến mãi hay không -->
                                                <span class="badge bg-danger position-absolute" style="top: 10px; left: 10px; z-index: 10;">Khuyến Mãi</span>
                                            @endif --}}
                                            
                                            <div class="img-container text-center mb-3" style=" overflow: hidden;">
                                                <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" 
                                                     class="img-fluid" 
                                                     alt="{{ $product->ten_san_pham }}" 
                                                     style="border-radius: 10px; width: auto;transition: transform 0.3s;min-height: 130px">
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
            <section class="product_poli_wrap mt-1 mb-3">
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
    <!-- Modal Structure -->
    <div id="popupModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Welcome to our Website</h2>
            <p>This is a beautiful centered popup.</p>
        </div>
    </div>
@endsection
@section('stylesheet')
<style>
    body{
        background: url('/assets/general/img/banner_background.png');
        /* background-size: cover; */
        background-attachment: fixed;
        margin: 0; 
    }
    .image-container {
        perspective: 1000px; /* Tạo chiều sâu cho hiệu ứng 3D */
    }

    .image-container img {
        transition: transform 0.6s; /* Thêm hiệu ứng chuyển tiếp cho hình ảnh */
    }

    .image-container:hover img {
        transform: rotateY(15deg); /* Lật hình ảnh theo trục Y khi di chuột */
    }

    .image-container:hover .image-overlay {
        opacity: 1; /* Hiện overlay khi di chuột */
    }
    
</style>
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

</script>
@endsection