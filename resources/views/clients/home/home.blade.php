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
    
    <section class="hero-section" style="margin-top:90px">
        <section class="mascot-section">
            <img src="{{asset('assets/general/img/bee.gif')}}" alt="Linh vật" class="mascot" style="width:100px">
        </section>        
        {{-- @include('Clients.blocks.sidebar') --}}
        <div class="container text-white">
            <h1>Chào Mừng Đến Với Cửa Hàng Gia Dụng Văn Hậu</h1>
            <p>Khám phá những sản phẩm tốt nhất cho ngôi nhà của bạn</p>
            <a href="#" class="btn btn-primary btn-lg" id="scroll-to-products">Mua Ngay</a>
        </div>
        <div class="video-container">
            <video autoplay loop muted class="custom-video">
                <source src="{{asset('assets/general/img/tvc_home.mp4')}}" type="video/mp4">
            </video>
        </div>
    </section>
    <div class="social-info">
        <div class="social facebook">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div class="social twitter">
            <a href=""><i class="fa-brands fa-twitter" style="color: black"></i></a>
        </div>
        <div class="social youtube">
            <a href=""><i class="fa-brands fa-youtube" style="color: red"></i></a>
        </div>
        <div class="social telegram">
            <a href=""><i class="fa-brands fa-telegram" style="color:#3AAFE1;"></i></a>
        </div>
    </div>
    <main class="container my-5 pt-4">
        <div class="row">
            <div class="col-lg-3">
                <!-- Sidebar Categories -->
                <h5 class="mb-4">Danh mục sản phẩm</h5>
                <ul class="list-group">
                    <li class="list-group-item"><a href="#" class="category-link">Nồi Chảo</a></li>
                    <li class="list-group-item"><a href="#" class="category-link">Gia Dụng Bếp</a></li>
                    <li class="list-group-item"><a href="#" class="category-link">Máy Xay</a></li>
                    <li class="list-group-item"><a href="#" class="category-link">Thiết Bị Điện</a></li>
                    <li class="list-group-item"><a href="#" class="category-link">Chăm Sóc Sức Khỏe</a></li>
                </ul>
            </div>
            <div class="col-lg-9" id="featured-products">
                <!-- Featured Products -->
                <h5 class="mb-4">Sản Phẩm Nổi Bật</h5>
                <div class="row">
                    @foreach ($productList as $product)
                        <div class="col-6 col-md-4 mb-4">
                            <a href="#" class="product-link">
                                <div class="product-item border p-3 d-flex flex-column" style="min-height: 450px; border-radius: 10px; transition: all 0.3s ease;">
                                    <div class="img-container">
                                        <img src="{{ asset('storage/products/img/' . $product->anh) ?: 'https://via.placeholder.com/150' }}" class="img-fluid" alt="{{ $product->ten_san_pham }}" style="border-radius: 10px;">
                                    </div>
                                    <h6 class="mt-2 text-center" style="min-height: 80px;">{{ $product->ten_san_pham }}</h6>
                                    <p class="text-muted text-decoration-line-through" style="margin-bottom: 2px;margin-top:-5px">{{ number_format($product->don_gia_goc, 0, ',', '.') }}đ</p>
                                    <p class="text-danger fw-bold" style="font-size: 1.25rem;">{{ number_format($product->don_gia, 0, ',', '.') }}đ</p>
                                    <a href="#" class="btn btn-primary mt-auto">Xem Chi Tiết</a>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div style="display: flex; justify-content: center; height: 20px; font-size: 20px;">
                        {{-- {{$productList->links()}} --}}
                    </div> 
                </div>
            </div>
        </div>
    </main>
    
  </section>

  <!-- Promotions Section -->
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
@section('stylesheet')
<style>
    .product-item{
        transition: all .5s ease;
        cursor: pointer;
    }
    .product-item:hover{
        translate: 0px -10px;
        border: 5px solid red;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }
    .list-group-item {
        position: relative; /* Để dễ dàng sử dụng vị trí cho thẻ a */
        padding: 0;
    }

    .category-link {
        display: block; /* Làm cho thẻ a chiếm toàn bộ không gian */
        padding: 10px; /* Thêm padding để cải thiện trải nghiệm người dùng */
        color: #333; /* Màu chữ cho danh mục */
        text-decoration: none; /* Không gạch chân */
        transition: background-color 0.3s; /* Hiệu ứng chuyển màu nền */
    }

    .category-link:hover {
        background-color: #e2e6ea; /* Màu nền khi hover */
        color: #007bff; /* Màu chữ khi hover */
    }
</style>
@endsection
{{-- js --}}
@section('js')
<script>
    document.getElementById('scroll-to-products').addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn không cho trang tải lại
        document.getElementById('featured-products').scrollIntoView({
            behavior: 'smooth' // Cuộn xuống mượt mà
        });
    });
</script>
@endsection