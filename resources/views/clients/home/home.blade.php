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
        <main class="container my-2">
            <!-- Danh mục sản phẩm -->
            <section class="category-section py-1">
                <div class="container">
                    <div class="row">
                        @include('clients.blocks.categories')
                        <!-- Hình ảnh sản phẩm -->
                        <div class="col-lg-9 img-baiviet p-3 rounded" style="background:#DEEFE7;">
                            @if(!empty($posts))
                                <div class="row g-2">
                                    @foreach($posts as $post)
                                        <div class="col-md-4"> <!-- Sử dụng col-md-4 để tạo 3 cột -->
                                            <a href="{{route('home.get_bai_viet',$post->slug)}}" class="image-link">
                                                <div class="image-container position-relative overflow-hidden">
                                                    <img src="{{$post->anh_bia ? 'storage/posts/img/'.$post->anh_bia :'https://www.fivebranches.edu/wp-content/uploads/2021/08/default-image.jpg'}}" alt="{{$post->tieu_de}}" class="img-fluid rounded shadow" style="object-fit: cover; height: 250px; width: 100%;">
                                                    <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s;">
                                                        <span class="text-white fw-bold" style="font-size: 1.25rem;">{{$post->tieu_de}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
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
                                <div class="col-6 col-md-4 col-lg-2 mb-3 gap-1"> <!-- Thêm khoảng cách dưới cho mỗi sản phẩm -->
                                    <a href="{{route('home.chi_tiet_sp',$product->maSP)}}" class="product-link text-decoration-none">
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
        e.preventDefault(); // Ngăn không cho trang tải lại
        document.getElementById('featured-products').scrollIntoView({
            behavior: 'smooth' // Cuộn xuống mượt mà
        });
    });
    document.querySelectorAll('.image-container').forEach(item => {
        item.addEventListener('mouseover', event => {
            item.querySelector('img').style.transform = 'scale(1.1)'; // Phóng to ảnh khi di chuột
        });

        item.addEventListener('mouseout', event => {
            item.querySelector('img').style.transform = 'scale(1)'; // Khôi phục kích thước ảnh
        });
    });
    // Get modal element
    const modal = document.getElementById("popupModal");
    // Get close button
    const closeBtn = document.querySelector(".close-btn");

    // Show modal when the page loads
    window.onload = function() {
        modal.style.display = "flex";
    }

    // Close modal when user clicks the close button
    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Optionally, close modal when user clicks anywhere outside the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
@endsection