@extends('layouts.client')

@section('title')
    {{$title}}
@endsection
@section('content-clients')
<div class="main-home-pay">
    <div class="container pay mt-3" style="padding: 52px 0px 0px;min-height: 100vh"> 
        <div class="row path p-2 d-flex align-items-center mb-3" style="background-color: white;border-radius: 20px">
            <h6 class="m-0">
                <a href="{{route('home.index')}}"><i class="fa-solid fa-house"></i></a> > 
                <a href="#" style="color:blue">Giỏ hàng</a>
            </h6>
        </div>
            <div class="d-grid" style="grid-template-columns: 1.4fr 0.6fr; gap:15px;">
                <div class="col-left-product">
                    {{-- SẢN PHẨM TRONG ĐƠN --}}
                    <div class="bg-white product-list-pay p-3 mb-3" style="border-radius: 20px;">
                        @if(!Auth::check())
                        <form action="{{route('home.cart.update')}}" method="POST">
                            @csrf
                            <div class="product-cart d-flex justify-content-between">
                                <h6 class="fw-bold">Sản phẩm trong giỏ hàng ({{count(Cart::content())}})</h6>
                                @if(Cart::count() > 0)
                                    <div class="btn_update_delete">
                                        <input type="submit" value="Cập Nhật Giỏ Hàng" class="btn btn-primary btn-sm" name="btn_update" id="">
                                        <a href="{{route('home.cart.destroy')}}" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?')" class="btn btn-danger btn-sm">Xóa tất cả</a>
                                    </div>
                                @else
                                <a href="{{ route('home.products.index') }}" class="btn btn-primary btn-sm">Tiếp Tục Mua Sắm</a>
                                @endif
                            </div>
                                <div class="product-item-pay d-flex flex-column">
                                    @php
                                        $num = 0
                                    @endphp
                                    @foreach(Cart::content()->sortByDesc(function($item) {
                                        return $item->options->added_at;
                                    }) as $item)
                                        @php
                                            $num++;
                                        @endphp
                                        <div class="product-item-pay d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
                                            <div class="product-img-name d-flex">
                                                <div class="product-img-pay me-2">
                                                    <span class="me-2">{{$num}}</span>
                                                    <a href="{{ route('home.chi_tiet_sp',$item->options->slug) }}">
                                                        <img src="{{asset('storage/products/img/'.$item->options->anh)}}" alt="{{ $item->options->anh }}" style="width: 120px; height: auto;" class="border rounded p-2" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                                    </a>
                                                </div>
                                                <div class="product-name-pay">
                                                    <h5 style="font-size: 17px; font-weight: bold;"><a href="{{ route('home.chi_tiet_sp',$item->options->slug) }}">{{ $item->name }}</a></h5>
                                                    <h6 style="font-size: 12px">Danh mục: {{$item->options->ten_danh_muc}} | NSX: {{$item->options->ten_NSX}}</h6>
                                                        <input type="number" name="qty[{{$item->rowId}}]" value="{{ $item->qty }}" min="1" max="100" class="d-inline" style="border-radius: 5px; border: 1px solid #ccc">
                                                </div>
                                            </div>
                                            <div class="product-price d-flex flex-column align-items-end">
                                                <h5 style="color:red; font-weight: bold">{{ number_format($item->price*$item->qty, 0, ',', '.')  }} đ <span style="color:black"></span></h5>
                                                    <a href="{{route('home.cart.remove',$item->rowId)}}" class="btn btn-danger btn-sm mt-1">Xóa</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        @else
                         <h6 class="fw-bold">Sản phẩm trong giỏ hàng (0)</h6>
                        @endif
                    </div>
                </div>
            
                <div class="bg-white p-3" style="border-radius: 20px; position:sticky; top: 70px; height: 400px; box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
                    {{-- THÔNG TIN ĐƠN HÀNG --}}
                    <h6 class="fw-bold mb-3">Thông tin giỏ hàng</h6>
                    <div class="total-price d-flex justify-content-between border-bottom">
                        <h6>Tổng tiền</h6>
                        <h6 style="font-size: 20px; font-weight: bold">
                            <span id="total-price">
                                @if(!Auth::check())
                                {{ Cart::total()}}đ
                                @else
                                    0đ
                                @endif
                            </span>
                        </h6>
                    </div>
            
                    <div class="total-promotion mt-3 d-flex justify-content-between">
                        <h6>Tổng khuyến mãi</h6>
                        <h6 style="font-size: 17px">0đ</h6>
                    </div>
            
                    <div class="shipping mt-3 d-flex justify-content-between border-bottom">
                        <h6>Phí vận chuyển</h6>
                        <input type="hidden" value="0" name="money_ship">
                        <h6 style="font-size: 17px">Miễn phí</h6>
                    </div>
            
                    <div class="shipping mt-3 d-flex justify-content-between border-bottom">
                        <h6>Cần thanh toán</h6>
                        <input type="hidden" value="42.140.000đ" name="total-pay">
                        <h6 style="font-size: 20px; color:red; font-weight: bold;">{{Cart::total()}}đ</h6>
                    </div>
                        <a href="{{route('home.pay.index')}}" class="btn btn-warning mt-3 w-100">Xác Nhận Đơn Hàng</a>
                    <div class="dieukhoan mt-3 text-center">
                        <h6 style="font-size: 13px">Bằng việc tiến hành đặt mua hàng, bạn đồng ý với <a href="" style="color:green">Điều khoản dịch vụ</a> và <a href="" style="color:green">Chính sách xử lý dữ liệu cá nhân</a> của Gia Dụng Văn Hậu.</h6>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <a href="{{ route('home.products.index') }}" class="btn btn-danger btn-sm">Tiếp Tục Mua Sắm</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection
@section('stylesheet')
    <style>
        .main-home-pay{
            background-color:#F3F4F6;
            width: 100%; 
            margin: 0 auto;
            padding: 5px;
        }
        .container.pay{
            width: 1470px;
            margin:0 auto;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
        }

        input:checked + .slider {
        background-color: #2196F3;
        }

        input:checked + .slider:before {
        transform: translateX(26px);
        }
        .custom-radio {
            width: 20px;
            height: 20px;
            }
    </style>
@endsection
