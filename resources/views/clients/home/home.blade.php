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
            <a href="#" class="btn btn-primary btn-lg">Mua Ngay</a>
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
  <main class="container my-3">
    <div class="row">
        <div class="col-lg-3">
            <!-- Sidebar Categories -->
            <h5 class="mb-4">Danh mục sản phẩm</h5>
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Nồi Chảo</a></li>
                <li class="list-group-item"><a href="#">Gia Dụng Bếp</a></li>
                <li class="list-group-item"><a href="#">Máy Xay</a></li>
                <li class="list-group-item"><a href="#">Thiết Bị Điện</a></li>
                <li class="list-group-item"><a href="#">Chăm Sóc Sức Khỏe</a></li>
            </ul>
        </div>
        <div class="col-lg-9">
            <!-- Featured Products -->
            <h5 class="mb-4">Sản Phẩm Nổi Bật</h5>
            <div class="row">
                @foreach ($productList as $product)
                    <div class="col-6 col-md-3 mb-4">
                        <div class="product-item border p-3 d-flex flex-column" style="min-height: 430px; border-radius: 10px">
                            <div class="img-container">
                                <img src="{{ $product->anh }}" class="img-fluid" alt="{{ $product->ten_san_pham }}" >
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
{{-- js --}}
@section('js')

@endsection