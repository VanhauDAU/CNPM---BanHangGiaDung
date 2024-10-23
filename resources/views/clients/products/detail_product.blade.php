@extends('layouts.client')
@section('title')
    {{$title}}
@endsection

@section('content-clients')
<div class="main-products">
    <header class="header-style-3 py-3" id="header-style-3">
        <nav class="navbar navbar-expand-lg shadow-sm fixed-top"   style="background-color: white; border-bottom: 1px solid #ccc;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
          <div class="container">
            <div class="row_navbar w-100 d-flex justify-content-between align-items-center">
                <div class="header-product-info">
                    <div class="header-product-info-img d-flex">
                        
                        <img src="{{ asset('storage/products/img/' . $productDetail->anh) ?: 'https://via.placeholder.com/150' }}" id="product-image" class="img-fluid rounded me-2" alt="{{ $productDetail->ten_san_pham }}" style="object-fit: cover;border-radius: 15px; width:45px">
                        <div class="header-product-info-name">
                            <h6 style="font-weight:bold">{{$productDetail->ten_san_pham}} ({{$productDetail->maSP}})</h6>
                            <h6 style="font-weight:bold; color: green">NSX:{{$productDetail->ten_NSX}}</h6>
                        </div>
                    </div>
                </div>
                <div class="header-product-buy-list d-flex align-items-center">
                    <div class="hedaer-product-price">
                        {{number_format($productDetail->don_gia)}}đ </br>
                       <s>{{number_format($productDetail->don_gia_goc)}}đ</s> 
                    </div>
                    <div class="header-product-buy mx-2">
                        <form action="" method="POST">
                            <button  class="btn btn-danger"><i class="fas fa-shopping-cart"></i>MUA NGAY</button>
                        </form>
                    </div>
                    <div class="header-product-cart">
                        
                            <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i></button>
                    </div>
                </div>
            </div>
          </div>
      </nav>
    </header>
    <div class="container mt-2" style="padding: 50px 0px 0px;">
            {{-- đường dẫn --}}
            <div class="breadcrumb d-flex align-items-center">
                <a href="{{route('home.products.index')}}"><i class="fa-solid fa-house"></i></a>
                <span class="separator">></span>
                <a href="{{route('home.products.sanpham_id',$productDetail->slugDm)}}" class="breadcrumb-link">{{$productDetail->ten_danh_muc}}</a>
                <span class="separator">></span>
                <a href="{{route('home.products.sanpham_id_id',[$productDetail->slugDm,$productDetail->slugCm])}}" class="breadcrumb-link">{{$productDetail->ten_chuyen_muc}}</a>
                <span class="separator">></span>
                <span class="current">{{$productDetail->ten_san_pham}}</span>
            </div> 
            <div class="row ps-2 d-flex justify-content-between">
                <div class="img-product col-md-6 image-magnifier-container px-5">
                    <div class="product-image-list">
                        @foreach($images as $image)
                            <img src="{{ asset('storage/products/img/' . $image->anh) ?: 'https://via.placeholder.com/150' }}" 
                            id="product-image" 
                            class="w-100 product-image img-fluid rounded" 
                            alt="{{ $productDetail->ten_san_pham }}" 
                            style="object-fit: contain; padding: 19px; border-radius: 15px; max-height: 350px; width: auto;">
                        @endforeach
                    </div>
                    <div class="row d-flex justify-content-center gap-2 my-2">
                        @foreach($images as $image)
                            <img class="rounded border thumbnail-image" 
                                 src="{{ asset('storage/products/img/' . $image->anh) ?: 'https://via.placeholder.com/150' }}" 
                                 alt="{{ $productDetail->ten_san_pham }}" 
                                 style="width: auto; height: 50px;" 
                                 onclick="showImage('{{ asset('storage/products/img/' . $image->anh) }}')"> <!-- Thêm sự kiện onclick -->
                        @endforeach
                    </div>
                    
                    <div class="img-magnifier-glass"></div> <!-- Kính lúp -->
                    <button class="ms-3" onclick="scrollToComments()">Xem đánh giá</button>
                    <img alt="Giá online (off 15/10)" loading="lazy" decoding="async" data-nimg="fill" class="relative w-auto object-contain ms-5" sizes="100vw" 
                    srcset="https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=640&amp;q=100 640w, https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=750&amp;q=100 750w, https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=828&amp;q=100 828w, https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=1080&amp;q=100 1080w, https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=1200&amp;q=100 1200w, https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=1920&amp;q=100 1920w" src="https://cdn2.fptshop.com.vn/svg/Badge_Chi_tiet_Online_sieu_re_26298fd98f.svg?w=1920&amp;q=100" 
                    style="height: 40px; width: 80px; inset: 0px; color: transparent;">
                </div>
                <div class="info-general-product col-md-6 ps-0">
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
                        <h6 style="font-size: 15px">Thương hiệu: <mark><a href="{{route('home.getBrand',$productDetail->slug)}}">{{$productDetail->ten_NSX}}</a> | {{$productDetail->ten_chuyen_muc}}</mark></h6>
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
                                @if($productDetail->so_luong_ton != 0)
                                <form action="{{route('home.cart.add', $productDetail->maSP)}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label for="so_luong" class="col-form-label me-2">Số lượng:</label>
                                                <div class="input-group" style="width: 130px;">
                                                    <input type="number" id="so_luong" name="so_luong" min="1" max="100" value="1" class="form-control text-center">
                                                </div>
                                            </div>
                                            <div class="col-md-6 d-flex align-items-end " style="margin-left: -50px">
                                                <button type="submit" id="add-to-cart" class="btn btn-success " ><i class="fas fa-shopping-cart"></i> Thêm vào giỏ</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row mt-2">
                                        <div class="btn-buy-wrap buy-now p-0">
                                            <button type="button" class="btn-shopp-manual btn-buy btn-order button-buy w-100 d-flex justify-content-center align-items-center"style="background-color:#DA251C" id="btn-buy-prod" data-tips="Giao hàng toàn quốc">
                                                <div class="col-md-1">
                                                    <i class="fa-solid fa-cart-shopping fs-3"></i>
                                                </div>
                                                <div class="col-md-11">
                                                    <h5 class="txt-shop m-0">
                                                        <span class="txt-buy-now" style="font-size: 15px; margin-top: -5px"><span style="font-size: 20px">Mua Ngay</span><br/>
                                                            (giao hàng tận nơi trên toàn quốc)
                                                        </span>
                                                    </h5>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                <div class="row mt-2">
                                    <div class="btn-buy-wrap buy-now p-0">
                                        <button type="button" class="btn-shopp-manual btn-buy btn-order button-buy w-100 d-flex justify-content-center align-items-center"style="background-color:green" id="btn-buy-prod" data-tips="Giao hàng toàn quốc">
                                            <div class="col-md-1">
                                                <i class="fa-solid fa-cart-shopping fs-3"></i>
                                            </div>
                                            <div class="col-md-11">
                                                <h5 class="txt-shop m-0">
                                                    <span class="txt-buy-now" style="font-size: 15px; margin-top: -5px"><span style="font-size: 20px">Liên Hệ</span><br/>
                                                        (giao hàng tận nơi trên toàn quốc)
                                                    </span>
                                                </h5>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                                @endif
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
                                <aside class="view-detail-right p-1 rounded" style="background-color: #FAFAFA;margin-top: -6px">
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
                                <a href="tel:0777464347">
                                    <div class="row p-3 align-items-center">
                                        <div class="col-auto">
                                            <i class="fa-solid fa-phone fa-lg fs-2 text-danger shake"></i>
                                        </div>
                                        <div class="col">
                                            <h6>
                                                Gọi <span style="color: red; font-weight: bold;">0777.46.43.47</span> để được tư vấn 
                                                <span style="font-size: 14px;">(Không miễn phí)</span>
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4" style="border-radius: 25px; background-color:#D9D9D9;margin:0px 10px; padding: 10px 15px; padding-bottom: 25px">
                <div class="row m-0 mt-4"style="border-radius: 25px; background-color:white; padding: 15px 10px">
                    <div class="col-md-7 p-1">
                        <h5 class="m-0 pt-2 pb-2 fs-4 text-uppercase fw-bold">Thông tin sản phẩm</h5>
                        <div class="mota bg-white p-3 rounded border" style="max-height: 600px; overflow-y:auto">
                            {!!$productDetail->mo_ta!!}
                        </div>
                    </div>
                    <div class="col-md-5 pt-1">
                        <h5 class="m-0 pt-2 pb-2 fs-4 text-uppercase fw-bold text-center">Sản phẩm liên quan</h5>
                        <div class="list-product p-2 mota " style="max-height: 600px; overflow-y:auto">
                            @if(!empty(get5Product($productDetail->id_chuyen_muc,$productDetail->maSP)))
                                @foreach(get5Product($productDetail->id_chuyen_muc,$productDetail->maSP) as $item)
                                <a href="{{route('home.chi_tiet_sp',$item->slug)}}">
                                    {{-- {{dd(get5Product($productDetail->id_danh_muc,$productDetail->maSP))}} --}}
                                    <div class="product-item p-2 rounded d-flex border">
                                        <img loading="lazy" src="{{asset('storage/products/img/'.$item->anh)}}" alt="" class="border rounded" style="min-width: 150px; max-height:100px">
                                        <div class="info-product ms-1">
                                            <h5 style="font-size:13px">
                                                {{\Illuminate\Support\Str::limit($item->ten_san_pham,50)}}
                                            </h5>
                                            <div class="price fw-bold text-danger">

                                                {{number_format($item->don_gia)}}đ
                                            </div>
                                            <div class="brand mt-2" style="font-size: 14px">
                                                {{$item->ten_NSX}} || {{$item->ten_chuyen_muc}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row m-0 mt-4 p-4" id="comments" style="border-radius: 25px; background-color:white; padding: 15px 10px">
                    @if(CountCmt($productDetail->maSP) == 0)
                        <div class="col-md-12">
                            <h5 class="text-capitalize fw-bold py-2 fs-3">Khách hàng nói về sản phẩm</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row border rounded firtUserReview p-3 d-flex">
                                    <div class="reviewFirst col-md-7">
                                        <h3 style="font-size: 20px" >Trở thành người đầu tiên đánh giá về sản phẩm</h3>
                                        <button class="btn btn-primary col-md-6 mt-3" onclick="checkLoginAndRedirect()">Đánh giá về sản phẩm</button>
                                    </div>
                                    <div class="image-reviewFirst col-md-5">
                                        <img src="https://fptshop.com.vn/img/imgStar.png?w=1920&q=100" alt="Đánh giá sản phẩm" style="width: 280px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            function checkLoginAndRedirect() {
                                // Giả định bạn có một biến JavaScript để kiểm tra trạng thái đăng nhập
                                const isLoggedIn = @json(Auth::check());

                                if (!isLoggedIn) {
                                    // Nếu chưa đăng nhập, hiển thị thông báo
                                    alert("Bạn cần đăng nhập để đánh giá sản phẩm!");
                                    window.location.href = '/login'; // Thay đổi đường dẫn theo trang đăng nhập của bạn
                                } else {
                                    // Nếu đã đăng nhập, thực hiện hành động khác, ví dụ, mở form đánh giá
                                    // openReviewForm(); // Hàm mở form đánh giá nếu bạn có
                                    console.log("Đã đăng nhập, mở form đánh giá.");
                                }
                            }
                        </script>
                    @else
                    @endif
                    <div class="row mt-3">
                        <div class="col-md-12  d-flex justify-content-between">
                            <div class="col-md-4 d-flex align-items-center">
                                @if(Auth::check())
                                    <img src="{{asset('storage/users/img/'.Auth::user()->anh)}}" alt="" class="me-3 border-circle border-primary" style="width: 50px; border-color: red">
                                    Bình luận với tư cách: <span class="fw-bold">{{Auth::user()->ho_ten}}</span>
                                @endif
                            </div>
                            
                            <div class="col-md-4 rating-stars">
                                <input type="radio" name="rating" id="rating-6" value="6">
                                <label for="rating-6" class="star" data-value="6">Tất cả</label>

                                <input type="radio" name="rating" id="rating-5" value="5">
                                <label for="rating-5" class="star" data-value="5">5<i class="fa-solid fa-star"></i></label>
                    
                                <input type="radio" name="rating" id="rating-4" value="4">
                                <label for="rating-4" class="star" data-value="4">4<i class="fa-solid fa-star"></i></label>
                    
                                <input type="radio" name="rating" id="rating-3" value="3">
                                <label for="rating-3" class="star" data-value="3">3<i class="fa-solid fa-star"></i></label>
                    
                                <input type="radio" name="rating" id="rating-2" value="2">
                                <label for="rating-2" class="star" data-value="2">2<i class="fa-solid fa-star"></i></label>
                    
                                <input type="radio" name="rating" id="rating-1" value="1">
                                <label for="rating-1" class="star" data-value="1">1<i class="fa-solid fa-star"></i></label>
                            </div>                           
                        </div>
                    </div>
                    @if (Auth::check())
                    <form action="{{ route('home.chi_tiet_sp.comment', $productDetail->maSP) }}" method="POST">
                        @csrf
                        <div class="row mt-3 mb-3">
                            <div class="col-md-9 d-flex gap-3">
                                <input type="text" class="form-control flex-grow-1 " name="noi_dung" id="noi_dung" placeholder="Nhập nội dung bình luận">
                                <button type="submit" class="btn btn-primary col-2 bg-black">Gửi bình luận</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-4">
                        <hr>
                        <h4>Bình luận: 
                            <span class="running-text" style="font-size: 20px">
                                @if(!empty(CountCmt($productDetail->maSP)))
                                    {{CountCmt($productDetail->maSP)}} Bình Luận
                                @else
                                    0 Bình Luận
                                @endif
                            </span>
                        </h4>
                        {{-- BÌNH LUẬN ĐÃ ĐĂNG NHẬP --}}
                        <div class="cmt-scroll">
                            @foreach ($commentSP as $comment)
                                <div class="comment mb-4 border p-3 rounded">
                                    <div class="d-flex align-items-start">
                                        <img src="
                                            @if(!empty($comment->providerGG == 'google'))
                                                {{ $comment->anh }}
                                            @elseif($comment->providerGG == 'account')
                                                {{ asset('storage/users/img/' . $comment->anh) }}
                                            @else
                                                https://as1.ftcdn.net/v2/jpg/03/46/83/96/1000_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg
                                            @endif
                                        "
                                        alt="" class="rounded-circle img-usercmt" width="50" height="50">
                                        <div class="ml-3">
                                            <strong>{{ $comment->ho_ten_KH ??  $comment->ho_ten_KHVL}}
                                                @if($comment->providerGG == 'google' || $comment->providerGG == 'account')
                                                    @if(!empty($comment->loai_tai_khoan == 0))
                                                        <span class="badge bg-success">[KHÁCH HÀNG]</span>
                                                    @elseif(!empty($comment->maCVMain == 1))
                                                        <span class="badge bg-danger">[ADMIN]</span>      
                                                    @elseif(!empty($comment->maCVMain == 2 || $comment->maCVMain == 3))
                                                        <span class="badge bg-info">[NHÂN VIÊN]</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-success">[KHÁCH HÀNG VÃNG LAI]</span>
                                                @endif
                                            </strong>
                                            <p class="mb-2">{{ $comment->noi_dung }}</p>
                                            <div class="d-flex align-items-center">
                                                <small class="text-muted" style="font-size: 11px">
                                                    Bình luận: {{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i:s') }}
                                                    <br/>
                                                    Duyệt: {{ \Carbon\Carbon::parse($comment->updated_at)->format('d-m-Y H:i:s') }}
                                                </small>
                                                <button class="btn btn-link text-primary ms-auto reply-btn" data-comment-id="{{ $comment->id }}" style="padding: 2px 10px; margin: 0 !important">Trả lời</button>
                                            </div>
                                            <!-- Form trả lời chỉ hiển thị khi người dùng nhấn vào nút "Trả lời" -->
                                            <div id="replyFormContainer_{{ $comment->id }}" class="reply-form-container mt-2" style="display: none;">
                                                <h6 style="color:red">Bạn đang trả lời {{ $comment->ho_ten_KH ??  $comment->ho_ten_KHVL}}</h6>
                                                <form action="{{route('home.comment.reply')}}" class="replyForm d-flex align-items-start" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="maSP" id="" value="{{$productDetail->maSP}}">
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <textarea class="form-control" name="noi_dung" rows="2" placeholder="Nhập câu trả lời của bạn..." required></textarea>
                                                    <button type="submit" class="btn btn-primary ms-2 text-white">Gửi</button>
                                                </form>
                                            </div>
                                            {{-- Hiển thị phản hồi cho bình luận này --}}
                                            @if(isset($comment->replies) && !$comment->replies->isEmpty())
                                                <div class="replies mt-2">
                                                    @foreach($comment->replies as $reply)
                                                        @if($reply->trang_thai !=0)
                                                            <div class="reply d-flex align-items-start border-start ps-3 ms-3 mb-2" style="font-size: 0.9em;"> <!-- Giảm kích thước chữ -->
                                                                <img src="
                                                                @if(!empty($reply->providerReply == 'google'))
                                                                    {{ $reply->anh }}
                                                                @else
                                                                    {{ asset('storage/users/img/' . $reply->anh) }}
                                                                @endif
                                                                " 
                                                                alt="{{ $reply->ho_ten_KH }}" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                                                <div>
                                                                    <strong>{{ $reply->ho_ten_KH }}</strong>
                                                                    @if($reply->maCVReply == 1)
                                                                        <span class="badge bg-danger">[ADMIN]</span>      
                                                                    @elseif($reply->maCVReply == 2 || $reply->maCVReply == 3)
                                                                        <span class="badge bg-info">[NHÂN VIÊN]</span>
                                                                    @elseif($reply->maCVReply == 4)
                                                                        <span class="badge bg-success">[KHÁCH HÀNG]</span>
                                                                    @endif
                                                                    <p>{{ $reply->noi_dung }}</p>
                                                                    <small>{{ \Carbon\Carbon::parse($reply->created_at)->format('d/m/Y H:i') }}</small>
                                                                    <!-- Nút trả lời cho bình luận con -->
                                                                    <button class="btn btn-link text-primary ms-auto reply-btn-con" data-reply-id="{{ $reply->id }}" style="padding: 2px 10px; margin: 0 !important">Trả lời</button>
                                                                </div>
                                                            </div>
                                                            <!-- Form trả lời cho bình luận con -->
                                                            <div id="replyFormContainerCon_{{ $reply->id }}" class="reply-form-container mt-2 ms-5 mb-3" style="display: none;">
                                                                <h6 style="color:red">Bạn đang trả lời {{ $reply->ho_ten_KH }}</h6>
                                                                <form action="{{ route('home.comment.reply') }}" class="replyForm d-flex align-items-start" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="maSP" value="{{ $productDetail->maSP }}">
                                                                    <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                                                    <textarea class="form-control" name="noi_dung" rows="2" placeholder="Nhập câu trả lời của bạn..." required></textarea>
                                                                    <button type="submit" class="btn btn-primary ms-2 text-white">Gửi</button>
                                                                </form>
                                                            </div>
                                                            {{-- HIỂN THỊ BÌNH LUẬN CON CỦA BÌNH LUẬN CON --}}
                                                            @if(isset($reply->replies2) && !$reply->replies2->isEmpty())
                                                                {{-- {{dd($reply->replies2)}} --}}
                                                                <div class="replies mt-2 ms-5">
                                                                    @foreach($reply->replies2 as $reply2) <!-- Thay đổi từ $comment->replies2 sang $reply->replies2 -->
                                                                        @if($reply2->trang_thai !=0)
                                                                            <div class="reply d-flex align-items-start border-start ps-3 ms-3 mb-2" style="font-size: 0.9em;">
                                                                                <img src="{{ !empty($reply2->providerReply2 == 'google') ? $reply2->anhReply2 : asset('storage/users/img/' . $reply2->anhReply2) }}" 
                                                                                    alt="{{ $reply2->ho_ten_KH }}" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                                                                <div>
                                                                                    <strong>{{ $reply2->ho_ten_KH }}</strong>
                                                                                    @if($reply2->maCVReply2 == 1)
                                                                                        <span class="badge bg-danger">[ADMIN]</span>      
                                                                                    @elseif($reply2->maCVReply2 == 2 || $reply2->maCVReply2 == 3)
                                                                                        <span class="badge bg-info">[NHÂN VIÊN]</span>
                                                                                    @elseif($reply2->maCVReply2 == 4)
                                                                                        <span class="badge bg-success">[KHÁCH HÀNG]</span>
                                                                                    @endif
                                                                                    <p>{{ $reply2->noi_dung }}</p>
                                                                                    <small>{{ \Carbon\Carbon::parse($reply2->created_at)->format('d/m/Y H:i') }}</small>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                    @else
                    <!-- BÌNH LUẬN CHƯA ĐĂNG NHẬP -->
                    <form id="commentForm" action="{{ route('home.chi_tiet_sp.comment', $productDetail->maSP) }}" method="POST">
                        @csrf
                        <div class="row mt-3 mb-3">
                            <div class="col-md-6">
                                <h5>Thông tin bình luận</h5>
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                <input type="text" class="form-control mb-2" name="ho_ten" placeholder="Nhập họ tên">
                                @error('ho_ten')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <input type="email" class="form-control mb-2" name="email" placeholder="Nhập email">
                                <input type="text" class="form-control mb-2" name="so_dien_thoai" placeholder="Nhập số điện thoại">
                                <select name="gioi_tinh" class="form-control mb-2">
                                    <option value="">Chọn giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                    <option value="2">Khác</option>
                                </select>
                                <textarea class="form-control mb-2" name="noi_dung" placeholder="Nhập nội dung bình luận"></textarea>
                                <button id="showCommentForm" class="btn btn-primary col-12 bg-black">Gửi bình luận</button>
                            </div>
                            <div class="col-md-6">
                                <div class="row mt-4">
                                    <hr>
                                    @if(CountCmt($productDetail->maSP) == 0)
                                        <h4>Chưa có bình luận của khách hàng về bài viết này!</h4>
                                    @else
                                        <h4>Bình luận:</h4>
                                    @endif
                                    <div class="cmt-scroll" style="height: 400px">
                                        @foreach ($commentSP as $comment)
                                        <div class="comment mb-3 border p-2 rounded">
                                            <div class="d-flex align-items-start">
                                                <img style="img-usercmt" src="
                                                    @if(!empty($comment->providerGG == 'google'))
                                                        {{ $comment->anh }}
                                                    @elseif($comment->providerGG == 'account')
                                                        {{ asset('storage/users/img/' . $comment->anh) }}
                                                    @else
                                                        https://as1.ftcdn.net/v2/jpg/03/46/83/96/1000_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg
                                                    @endif
                                                    "
                                                  class="rounded-circle" width="40" height="40">
                                                <div class="ml-3">
                                                    <strong>
                                                        {{ $comment->ho_ten_KH ?? $comment->ho_ten_KHVL }} 
                                                        @if($comment->providerGG == 'google' || $comment->providerGG == 'account')
                                                            @if(!empty($comment->loai_tai_khoan == 0))
                                                                <span class="badge bg-success">[KHÁCH HÀNG]</span>
                                                            @elseif(!empty($comment->maCVMain == 1))
                                                                <span class="badge bg-danger">[ADMIN]</span>      
                                                            @else
                                                                <span class="badge bg-info">[NHÂN VIÊN]</span>
                                                            @endif
                                                        @else
                                                                <span class="badge bg-success">[KHÁCH HÀNG VÃNG LAI]</span>
                                                        @endif
                                                    </strong>
                                                    <p class="mb-1">{{ $comment->noi_dung }}</p>
                                                    <div class="row d-flex align-items-center">
                                                        <div class="timeCmt">
                                                            <small class="text-muted" style="font-size: 12px">
                                                                TG Bình Luận: {{ \Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i:s') }}
                                                                <br/>
                                                                TG Duyệt: {{ \Carbon\Carbon::parse($comment->updated_at)->format('d-m-Y H:i:s') }}
                                                            </small>
                                                        </div>
                                                        {{-- <div class="replyCmt ms-auto">
                                                            <button class="btn btn-primary text-white mt-2" style="padding: 1px 15px" onclick="replyToComment('{{ $comment->id }}')">Trả lời</button>
                                                        </div> --}}
                                                    </div>
                                                    {{-- Hiển thị phản hồi cho bình luận này --}}
                                            @if(isset($comment->replies) && !$comment->replies->isEmpty())
                                            <div class="replies mt-2">
                                                @foreach($comment->replies as $reply)
                                                    @if($reply->trang_thai !=0)
                                                        <div class="reply d-flex align-items-start border-start ps-3 ms-3 mb-2">

                                                            <img src="
                                                            @if(!empty($reply->providerReply == 'google'))
                                                                {{ $reply->anh }}
                                                            @else
                                                                {{ asset('storage/users/img/' . $reply->anh) }}"
                                                            @endif
                                                            " 
                                                            alt="{{ $reply->ho_ten_KH }}" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                                                            
                                                            <div>
                                                               {{-- {{ dd($comment)}} --}}
                                                                <strong>{{ $reply->ho_ten_KH }}</strong>
                                                                @if($reply->maCVReply == 1)
                                                                    <span class="badge bg-danger">[ADMIN]</span>   
                                                                @elseif($reply->maCVReply == 4)
                                                                    <span class="badge bg-success">[KHÁCH HÀNG]</span>
                                                                @else
                                                                    <span class="badge bg-info">[NHÂN VIÊN]</span>
                                                                @endif
                                                                <p>{{ $reply->noi_dung }}</p>
                                                                <small>{{ \Carbon\Carbon::parse($reply->created_at)->format('d/m/Y H:i') }}</small>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @if (session('success'))
                                            <script>
                                                Swal.fire({
                                                    title: "Thành công!",
                                                    text: "{{ session('success') }}",
                                                    icon: "success"
                                                });
                                            </script>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
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
    .mota {
        max-height: 200px;
        overflow-y: auto;
    }
    .mota::-webkit-scrollbar {
        width: 10px; 
    }

    .mota::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .mota::-webkit-scrollbar-thumb {
        background-color: #DA251C;
        border-radius: 10px;
        border: 2px solid #f1f1f1;
    }

    .mota::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    form .form-control {
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
    }

    form button {
        padding: 10px 30px;
        font-size: 14px;
        border: none;
        border-radius: 5px;
    }

    form button:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .gap-3 {
        gap: 10px;
    }
    .replyCmt:hover button{
        text-decoration: none;
    }
</style>
@endsection
@section('js')
    <script>
         function scrollToComments() {
            document.getElementById('comments').scrollIntoView({
            behavior: 'smooth'  // Di chuyển mượt mà
            });
        }

        const stars = document.querySelectorAll('.star');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                stars.forEach(s => s.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
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
    
    document.addEventListener('DOMContentLoaded', function() {
        const header1 = document.getElementById('header-style-1');
        const header2 = document.getElementById('header-style-2');
        const header3 = document.getElementById('header-style-3');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 650) {
                header1.style.display = 'none';
                header2.style.display = 'none';
                header3.style.display = 'block';
                
            } else {
                // Nếu ở đầu trang, hiện header và ẩn footer
                header1.style.display = 'block';
                header2.style.display = 'none';
                header3.style.display = 'none';
            }
        });
    });
    </script>
@endsection