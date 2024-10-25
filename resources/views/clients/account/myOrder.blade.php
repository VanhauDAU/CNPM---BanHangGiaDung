@extends('layouts.client')

@section('title')
    Cập nhật thông tin
@endsection
@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="col-md-3">
                @include('clients.blocks.categoriesUser')
            </div>
            <div class="col-md-9">
                <div class="row d-flex align-items-center justify-content-between">
                <h4 class="col-auto mb-0 fw-bold">Đơn hàng của tôi</h4>
                <form action="" method="POST" class="col-6">
                    <div class="input-group">
                        <input type="text" class="form-control" style="border-radius: 20px;" name="findOrderInput" placeholder="Tìm theo tên đơn, mã đơn hoặc tên sản phẩm">
                        <button type="submit" class="search-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
            <ul class="nav nav-tabs mt-2 w-100 d-flex justify-content-between">
                <li class="nav-item flex-fill text-center">
                    <a class="nav-link {{ is_null($trang_thai) ? 'active' : '' }}" href="{{ route('home.account.myOrder') }}">Tất cả</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a class="nav-link {{ ($trang_thai == 0 && !is_null($trang_thai) ) ? 'active' : '' }}" href="{{ route('home.account.myOrder', ['trang_thai' => 0]) }}">Đang xử lý</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a class="nav-link {{ $trang_thai == 1 ? 'active' : '' }}" href="{{ route('home.account.myOrder', ['trang_thai' => 1]) }}">Đang giao</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a class="nav-link {{ $trang_thai == 2 ? 'active' : '' }}" href="{{ route('home.account.myOrder', ['trang_thai' => 2]) }}">Hoàn tất</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a class="nav-link {{ $trang_thai == 3 ? 'active' : '' }}" href="{{ route('home.account.myOrder', ['trang_thai' => 3]) }}">Đã hủy</a>
                </li>
                <li class="nav-item flex-fill text-center">
                    <a class="nav-link {{ $trang_thai == 4 ? 'active' : '' }}" href="{{ route('home.account.myOrder', ['trang_thai' => 4]) }}">Trả hàng</a>
                </li>
            </ul>
            <div class="listOrder">
                @foreach($Orders as $order)
                    <div class="order-item p-3 bg-white mb-2" style="border-radius: 10px; ">
                        <div class="order-header d-flex justify-content-between border-bottom pb-2" style="font-size: 13px">
                            <div class="order-id d-flex align-items-center">
                                <span class="fw-bold">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</span>
                                <i class="fa-solid fa-circle mx-1" style="color:#ddd; font-size: 5px"></i>
                                <span>MaHD: {{$order->id}}</span>
                                <i class="fa-solid fa-circle mx-1" style="color:#ddd; font-size: 5px"></i>
                                <span>{{count($order->OrderDetail)}} sản phẩm</span>
                            </div>
                            <div class="order-status">
                                <span class="status d-flex align-items-center">
                                    @if($order->trang_thai ==0)
                                        <i class="fa-solid fa-circle me-2" style="color:#DA790A; font-size: 10px"></i>
                                        <h6 class="mb-0" style="color: #DA790A">Đang xử lý</h6>
                                    @elseif($order->trang_thai ==1)
                                        <i class="fa-solid fa-truck me-2" style="color:#223240; font-size: 10px"></i>
                                        <h6 class="mb-0" style="color: #223240">Đang giao</h6>
                                    @elseif($order->trang_thai ==2)
                                        <i class="fa-solid fa-circle me-2" style="color:#3B8C66; font-size: 10px"></i>
                                        <h6 class="mb-0" style="color: #3B8C66">Hoàn tất</h6>
                                    @elseif($order->trang_thai ==3)
                                        <i class="fa-solid fa-ban me-2" style="color:#E02914; font-size: 10px"></i>
                                        <h6 class="mb-0" style="color: #E02914">Đã hủy</h6>
                                    @else
                                        <i class="fa-solid fa-rotate me-2" style="color:#BD2A2E; font-size: 10px"></i>
                                        <h6 class="mb-0" style="color: #BD2A2E">Trả hàng</h6>
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="order-body mt-2 border-bottom pb-2">
                            @foreach($order->OrderDetail as $orderProduct)
                            <div class="order-products d-flex justify-content-between mb-2">
                                <div class="product-info d-flex">
                                    <div class="product-img border rounded me-2" style="min-width: 60px; max-height: 60px">
                                        <img width="60" src="{{asset('storage/products/img/'.$orderProduct->Product->anh)}}" alt="">
                                    </div>
                                    <div class="product-name">
                                        <h6>{{$orderProduct->Product->ten_san_pham}}</h6>
                                        <span style="font-size: 15px; color:#999">Số lượng: {{$orderProduct->so_luong}}</span>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <span class="fw-bold">{{number_format($orderProduct->gia,0,',','.')}}đ</span>
                                </div>
                            </div>
                            @endforeach
                            <div class="viewDetail mt-2 d-flex justify-content-between">
                                <a href="" style="color: blue; font-size: 15px">Xem chi tiết ></a>
                                <div class="totalOrder">
                                    <span>Thành tiền: <strong style="color:red">{{number_format($order->tong_tien,0,',','.')}}đ</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="order-bottom d-flex justify-content-between mt-2">
                            <span>Bạn cần hỗ trợ? Liên hệ ngay với chúng tôi</span>
                            <a href="tel::0777464347" style="background-color: red; color: white; padding: 5px 15px; border-radius: 12px">Hỗ trợ</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- If no orders -->
            @if(count($Orders) == 0)
            <div class="no-orders text-center">
                <img src="https://fptshop.com.vn/img/empty_state.png?w=360&q=100" alt="No Orders">
                <p>Bạn chưa có đơn hàng nào</p>
                <p>Cùng khám phá hàng ngàn sản phẩm tại Gia Dụng Văn Hậu Shop nhé!</p>
                <a href="{{route('home.products.index')}}" class="btn-viewProduct">Khám phá ngay</a>
            </div>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheetAccount')
<style>
    .main-posts{
        background-color: #F3F4F6;
    }
    .nav-tabs{
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        background-color: white;
        margin-bottom: 20px
    }
    .nav-tabs .nav-item a{
        color: #6B7280;
    }
    .nav-tabs .nav-item a.active,
    .nav-tabs .nav-item a:hover{
        color: #DA251C;
        border-bottom-color:#DA251C;
        border-bottom:3px solid #DA251C; 
    }
    .btn-viewProduct{
        padding: 5px 15px;
        background-color: #DA251C;
        border-radius: 20px;
        color: white;
        transition: all .4s;
        font-size: 18px;
    }
    .btn-viewProduct:hover{
        background-color:#B91C1C;
    }
    
</style>
@endsection