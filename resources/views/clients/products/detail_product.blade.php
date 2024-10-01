@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content-clients')
<div class="main-products">
    <div class="container mt-2" style="padding: 40px 0px 0px;">
            {{-- đường dẫn --}}
            <div class="breadcrumb d-flex align-items-center">
                <i class="fa-solid fa-house"></i>
                <span class="separator">></span>
                <a href="{{route('home.products.sanpham_id',$productDetail->id_danh_muc)}}" class="breadcrumb-link">{{$productDetail->ten_danh_muc}}</a>
                <span class="separator">></span>
                <a href="{{route('home.products.sanpham_id_id',[$productDetail->id_danh_muc,$productDetail->id_chuyen_muc])}}" class="breadcrumb-link">{{$productDetail->ten_chuyen_muc}}</a>
                <span class="separator">></span>
                <span class="current">{{$productDetail->ten_san_pham}}</span>
            </div> 
            <div class="row ps-2">
                <div class="img-product col-md-5 image-magnifier-container">
                    <img src="{{ asset('storage/products/img/' . $productDetail->anh) ?: 'https://via.placeholder.com/150' }}" id="product-image" class="product-image img-fluid" alt="{{ $productDetail->ten_san_pham }}" style="object-fit: cover;padding: 19px;border-radius: 10px; width:auto">
                    <div class="magnifier" id="magnifier"></div>
                </div>
                <div class="info-general-product col-md-7 ps-0">
                    <div class="name-product">
                        <h4 style="font-weight:bold">{{$productDetail->ten_san_pham}}</h4>
                    </div>
                    <div class="price_star d-flex justify-content-between align-items-center mt-4 mb-2">
                        <div class="star_danhgia d-flex align-items-center" style="font-size: 13px; color:orange">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <h6 class="mb-0 ms-2 text-primary" style="font-size: 13px">(14 đánh giá)</h6>
                        </div>
                    </div>
                    <div class="brand">
                        <h6 style="font-size: 15px">Thương hiệu: <mark>{{$productDetail->ten_NSX}} | {{$productDetail->ten_chuyen_muc}}</mark></h6>
                    </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="row info-pay">
                                    <div class="col-8">
                                        <h1 class="price running-text2 mt-2" style="font-weight:600; color:white; font-size: 35px">{{number_format($productDetail->don_gia)}}đ</h1>
                                        <div class="discount d-flex align-items-end text-white gap-2">
                                            <h6>-{{number_format((($productDetail->don_gia_goc - $productDetail->don_gia) / $productDetail->don_gia_goc)*100)}}%</h6>
                                            <h5 style="font-weight:400; font-size:16px"><s>{{number_format($productDetail->don_gia_goc)}}đ</s></h5>
                                            <h6>(Đã gồm VAT)</h6>
                                        </div>
                                    </div>
                                    <div class="col-4 text-white">
                                        <h6 style="font-size: 12px; left:0;text-align:right">Kết thúc sau</h6>
                                        <div class="time-discount d-flex gap-2 justify-content-end" >
                                            <div class="hour bg-white text-black ps-2 pe-2 pt-1 pb-1 rounded text-center" style="min-width: 40px">
                                                <div class="time">
                                                    20
                                                </div>
                                                <div class="title-time">
                                                    giờ
                                                </div>
                                            </div>
                                            <div class="minute bg-white text-black ps-2 pe-2 pt-1 pb-1 rounded text-center" style="min-width: 40px">
                                                <div class="time">
                                                    30
                                                </div> <div class="title-time">
                                                    phút
                                                </div>
                                            </div>
                                            <div class="second bg-white text-black ps-2 pe-2 pt-1 pb-1 rounded text-center" style="min-width: 40px">
                                                <div class="time">
                                                    40
                                                </div>
                                                <div class="title-time">
                                                    giây
                                                </div>
                                            </div>
                                        </div>
                                        <div class="num-product">
                                            <h6 class="mt-2" style="text-align: right">Còn: <span id="quantity">{{ $productDetail->so_luong_ton }}</span> chiếc</h6>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row mt-2">
                                    <h6>Trạng thái: <span style="margin-left: 15px"> {{$productDetail->so_luong_ton > 0 ? ' Còn hàng' : ' Tạm hết hàng'}}</span></h6>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                            <label for="quantity" class="col-form-label me-2">Số lượng:</label>
                                        <div class="input-group" style="width: 130px;">
                                            <button class="btn btn-outline-secondary" type="button" onclick="decrement()">-</button>
                                            <input type="number" id="stock-quantity" name="stock-quantity" min="1" max="100" value="1" class="form-control text-center">
                                            <button class="btn btn-outline-secondary" type="button" onclick="increment()">+</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end ">
                                        <button id="add-to-cart" class="btn btn-success" onclick="addToCart()" style="margin-left:-70px">
                                            <i class="fas fa-shopping-cart"></i> Thêm vào giỏ
                                        </button>
                                    </div>
                                    
                                </div>
                                <div class="row mt-2">
                                    <div class="btn-buy-wrap buy-now p-0">
                                        <button type="button" class="btn-shopp-manual btn-buy btn-order button-buy w-100 d-flex justify-content-center align-items-center"style="background-color:#DA251C" id="btn-buy-prod" data-tips="Giao hàng toàn quốc">
                                            <div class="col-md-1">
                                                <i class="fa-solid fa-cart-shopping fs-3"></i>
                                            </div>
                                            <div class="col-md-11">
                                                <h5 class="txt-shop m-0">
                                                    <span class="txt-buy-now" style="font-size: 15px; margin-top: -5px"><span style="font-size: 20px">Đặt mua</span><br/>
                                                        (giao hàng tận nơi trên toàn quốc)
                                                    </span>
                                                </h5>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="btn-buy-wrap buy-now p-0">
                                        <div class="border p-2 rounded w-100 d-flex justify-content-center align-items-center"style="background-color:white ;color:black;" id="btn-buy-prod" data-tips="Giao hàng toàn quốc">
                                            <div class="col-md-1 ">
                                                <i class="fa-solid fa-truck-fast fs-3" style="color: red;"></i>
                                            </div>
                                            <div class="col-md-11" style="margin-left: 10px">
                                                <h5 class="txt-shop m-0">
                                                    <h6 class="txt-buy-now" style="font-size: 12px">
                                                        Miễn phí giao hàng trong nội thành Hà Nội và nội thành TP. Đà Nẵng  <a href="#" style="color: blue"> (Xem thêm)</a>
                                                    </h6>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 p-3">
                                <aside class="view-detail-right p-3 rounded" style="background-color: #FAFAFA;margin-top: -6px">
                                    <div class="detail-right-box care-detail">
                                        <div class="detail-right-box-title" style="font-weight:600">Thông tin hữu ích</div>
                                        <div class="detail-right-box-wrap">
                                            <div class="care-detail-box">
                                                <div class="care-detail-item bao-hanh-care">
                                                    <a href="#">
                                                        <span>
                                                            <img alt="✓" height="12" src="https://meta.vn/images/tools-icon-s.png"></span>
                                                        <span class="txt-e-c">Trung tâm bảo hành</span>
                                                    </a>
                                                </div>
                                                <div class="care-detail-item van-chuyen-care">
                                                    <a href="#" rel="nofollow">
                                                        <span>
                                                            <img alt="✓" height="12" src="https://meta.vn/images/giao-hang-toan-quoc-icon.png"></span>
                                                        <span class="txt-e-c">Thông tin vận chuyển</span></a>
                                                </div>
                                                <div class="care-detail-item thanh-toan-care">
                                                    <a href="#" rel="nofollow">
                                                        <span>
                                                            <img alt="✓" height="12" src="https://meta.vn/images/dich-vu-uy-tin-icon.png"></span>
                                                        <span class="txt-e-c">Hướng dẫn thanh toán</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-0 mt-4 p-0" style="background: #ccc">
                    <div class="col-md-8 p-1">
                        <h5 class="m-0 pt-2 pb-2">Thông tin sản phẩm</h5>
                        <div class="mota bg-white p-3 rounded">
                            {!!$productDetail->mo_ta!!}
                        </div>
                    </div>
                    <div class="col-md-4">
        
                    </div>
                </div>
            </div>
    </div>
<div>
@endsection
@section('stylesheet')
<style>
    body{
        /* background-size: cover; */
        background-attachment: fixed;
        margin: 0; 
    }
    main{
        background-color: white;
        height: 100vh;
        display: block;
    }
    .container.detail_product{
        margin: 10px 0px 50px;
    }
    .img-product img{
        width: 100%;
    }
    .name-product h3{
        font-weight: 600;
    }
    input[type=number], button {
        padding: 5px;
        font-size: 16px;
    }

    button {
        cursor: pointer;
        border: none;
        background-color: #007bff;
        color: white;
        border:1px solid #ccc;
        border-radius: 5px;
    }

    button:hover {
        background-color: #0056b3;
    }

</style>
@endsection
@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const finalQuantity = {{ $productDetail->so_luong_ton }};
        let currentQuantity = 100; 
        const quantityElement = document.getElementById("quantity");
        const countdown = setInterval(function() {
            if (currentQuantity > finalQuantity) {
                currentQuantity--;
                quantityElement.textContent = currentQuantity; 
            } else {
                clearInterval(countdown);
            }
        }, 50); 
    });
    
    function increment() {
        var quantityInput = document.getElementById('stock-quantity');
        var currentValue = parseInt(quantityInput.value);
        const maxQuantity = {{ $productDetail->so_luong_ton }}; // Số lượng còn lại

        // Kiểm tra nếu giá trị hiện tại nhỏ hơn số lượng còn lại
        if (currentValue < maxQuantity) {
            quantityInput.value = currentValue + 1;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Lỗi!',
                text: 'Không thể chọn số lượng vượt quá số lượng còn lại!',
                confirmButtonText: 'OK',
                backdrop: true,
            });
        }
    }

    function decrement() {
        var quantityInput = document.getElementById('stock-quantity');
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    }
    function addToCart() {
        const quantityInput = document.getElementById('stock-quantity');
        const quantity = parseInt(quantityInput.value, 10);
        if (quantity < 1) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Số lượng phải lớn hơn 0!',
            });
            return;
        }

        // Thực hiện thao tác thêm sản phẩm vào giỏ hàng
        // Giả sử bạn có một API hoặc một hàm để xử lý thêm vào giỏ hàng
        // Ví dụ: gửi yêu cầu AJAX để thêm sản phẩm vào giỏ
        console.log(`Thêm ${quantity} sản phẩm vào giỏ hàng!`);
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: `Đã thêm ${quantity} sản phẩm vào giỏ hàng!`,
        });

        // Thực hiện thêm logic nếu cần thiết, như cập nhật giao diện
    }
    const magnifier = document.getElementById("magnifier");
    const productImage = document.getElementById("product-image");

    productImage.addEventListener("mousemove", function (e) {
        const x = e.pageX - productImage.offsetLeft; 
        const y = e.pageY - productImage.offsetTop; 

        // Tính toán vị trí kính lúp
        magnifier.style.left = x - magnifier.offsetWidth / 2 + "px";
        magnifier.style.top = y - magnifier.offsetHeight / 2 + "px";
        magnifier.style.opacity = 1; // Hiện kính lúp

        // Tính toán tỷ lệ zoom
        const zoomFactor = 2; // Hệ số zoom
        magnifier.style.backgroundImage = `url(${productImage.src})`;
        magnifier.style.backgroundSize = `${productImage.width * zoomFactor}px ${productImage.height * zoomFactor}px`;
        magnifier.style.backgroundPosition = `-${x * zoomFactor - magnifier.offsetWidth / 2}px -${y * zoomFactor - magnifier.offsetHeight / 2}px`;
    });

    productImage.addEventListener("mouseleave", function () {
        magnifier.style.opacity = 0; // Ẩn kính lúp khi rời chuột
    });

    </script>
@endsection