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
        <main class="container my-2">
            <!-- Danh mục sản phẩm -->
            <section class="category-section py-1">
                <div class="container">
                    <div class="row">
                        @include('clients.blocks.categories')
            
                        <!-- Hình ảnh sản phẩm -->
                        <div class="col-lg-9">
                            <div class="row g-3">
                                <div class="col-md-8">
                                    <a href="#" class="image-link">
                                        <div class="image-container position-relative overflow-hidden">
                                            <img src="https://st.meta.vn/img/thumb.ashx/Data/2024/Thang09/ho-tro/Banner-ho-tro-kiem-tra-san-pham-sau-bao-yagi-720x445.png" alt="Đồ Gia Dụng" class="img-fluid rounded shadow" style="object-fit: cover; height: 300px; width: 100%;">
                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                                <span class="text-white fw-bold" style="font-size: 1.5rem;">Đồ Gia Dụng</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="#" class="image-link">
                                        <div class="image-container position-relative overflow-hidden">
                                            <img src="https://st.meta.vn/Data/2024/Thang08/may-rua-bat-336x280.jpg" alt="Thời Trang" class="img-fluid rounded shadow" style="object-fit: cover; height: 300px; width: 100%;">
                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                                <span class="text-white fw-bold" style="font-size: 1.5rem;">Thời Trang</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
            
                            <div class="row g-3 mt-3">
                                <div class="col-md-3">
                                    <a href="#" class="image-link">
                                        <div class="image-container position-relative overflow-hidden">
                                            <img src="https://st.meta.vn/Data/2024/Thang02/cay-nuoc-nong-lanh-300x250.jpg" alt="Thể Thao" class="img-fluid rounded shadow" style="object-fit: cover; height: 250px; width: 100%;">
                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                                <span class="text-white fw-bold" style="font-size: 1.5rem;">Thể Thao</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="#" class="image-link">
                                        <div class="image-container position-relative overflow-hidden">
                                            <img src="https://st.meta.vn/Data/2019/Thang07/tu-lanh-mini-300x250.png" alt="Sức Khỏe" class="img-fluid rounded shadow" style="object-fit: cover; height: 250px; width: 100%;">
                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                                <span class="text-white fw-bold" style="font-size: 1.5rem;">Sức Khỏe</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="#" class="image-link">
                                        <div class="image-container position-relative overflow-hidden">
                                            <img src="https://st.meta.vn/img/thumb.ashx/Data/2024/Thang03/dien-may/Banner-dien-may-720x445.png" alt="Thêm Sản Phẩm" class="img-fluid rounded shadow" style="object-fit: cover; height: 250px; width: 100%;">
                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                                <span class="text-white fw-bold" style="font-size: 1.5rem;">Thêm Sản Phẩm</span>
                                            </div>
                                        </div>
                                    </a>
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
                    <div class="row my-5 justify-content-center">
                        @if(!empty(sanphamnoibat()))
                            @foreach (sanphamnoibat() as $product)
                                <div class="col-6 col-md-4 col-lg-2 mb-3"> <!-- Thêm khoảng cách dưới cho mỗi sản phẩm -->
                                    <a href="#" class="product-link text-decoration-none">
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
                                                     style="border-radius: 10px; width: auto;transition: transform 0.3s;">
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
                                            
                                            <a href="#" class="btn btn-outline-primary mt-auto w-100">Xem Chi Tiết</a>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
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