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
                <a href="" style="color:blue">Thanh toán</a>
            </h6>
        </div>
        <form action="" method="POST">
            @csrf
            <div class="d-grid" style="grid-template-columns: 1.4fr 0.6fr; gap:15px">
                <div class="col-left-product">
                    {{-- SẢN PHẨM TRONG ĐƠN --}}
                    @if(!Auth::check())
                        <div class="bg-white product-list-pay p-3 mb-3" style="border-radius: 20px;">
                            <h6 class="fw-bold">Sản phẩm trong đơn ({{count(Cart::content())}})</h6>
                            @foreach(Cart::content() as $item)
                                <div class="product-item-pay d-flex justify-content-between mb-2 border-bottom pb-2">
                                    <div class="product-img-name d-flex me-1">
                                        <div class="product-img-pay">
                                            <img class="border rounded p-2 me-2" style="width: 100px" src="{{ asset('storage/products/img/'.$item->options->anh) }}" alt="">
                                        </div>
                                        <div class="product-name-pay">
                                            <input type="hidden" name="name_product[]" value="{{ $item->name }}">
                                            <input type="hidden" name="so_luong_product[]" value="{{ $item->qty }}">
                                            <input type="hidden" value="{{ intval(str_replace('.', '',  $item->price)) }}" name="price_product[]">
                                            <h5>{{ $item->name }} (SL: {{ $item->qty }})</h5>
                                            <h6 style="font-size: 12px">Danh mục: {{ $item->options->ten_danh_muc }} | NSX: {{ $item->options->ten_NSX }}</h6>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h5 style="color:red; font-weight: bold">{{ number_format($item->price * $item->qty, 0, ',', '.') }}đ</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                    <div class="bg-white product-list-pay p-3 mb-3" style="border-radius: 20px;">
                        <h6 class="fw-bold">Sản phẩm trong đơn ({{count($cart)}})</h6>
                        @foreach($products as $item)
                            <div class="product-item-pay d-flex justify-content-between mb-2 border-bottom pb-2">
                                <div class="product-img-name d-flex me-1">
                                    <div class="product-img-pay">
                                        <img class="border rounded p-2 me-2" style="width: 100px" src="{{ asset('storage/products/img/'.$item->products->anh) }}" alt="">
                                    </div>
                                    <div class="product-name-pay">
                                        <input type="hidden" name="name_product[]" value="{{ $item->products->ten_san_pham }}">
                                        <input type="hidden" name="so_luong_product[]" value="{{ $item->qty }}">
                                        <input type="hidden" value="{{ intval(str_replace('.', '',  $item->don_gia)) }}" name="price_product[]">
                                        <h5>{{ $item->products->ten_san_pham }} (SL: {{ $item->qty }})</h5>
                                        <h6 style="font-size: 12px">Danh mục: {{ $item->products->danhMuc->ten_danh_muc }} | NSX: {{ $item->products->nhaSanXuat->ten_NSX }}</h6>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h5 style="color:red; font-weight: bold">{{ number_format($item->price, 0, ',', '.') }}đ</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                    @if(Auth::check())
                        {{-- Đã đăng nhập, lấy tên, sđt người đang đăng nhập --}}
                        <div class="bg-white p-3 mb-3 infoUserPay" style="border-radius: 20px;">
                            <h6 class="fw-bold titlecontentUser">Người đặt hàng</h6>
                            <div class="form-person-order border rounded p-2">
                                <input type="hidden" class="form-control mb-2" name="ho_ten" value="{{Auth::user()->ho_ten}}">
                                <input type="hidden" class="form-control mb-2" name="so_dien_thoai" value="{{Auth::user()->so_dien_thoai}}">
                                <input type="hidden" class="form-control mb-2" name="email" value="{{Auth::user()->email}}">
                                <h6>Họ tên: {{ Auth::user()->ho_ten }}</h6>
                                <h6>Email: {{ Auth::user()->email }}</h6>
                                @if(empty(Auth::user()->so_dien_thoai))
                                    <input type="text" id="so_dien_thoai_update" style="border-radius: 15px; padding: 5px 10px; border: 1px solid #ccc" placeholder="Nhập số điện thoại...">
                                    <button type="button" class="btn btn-primary btn-sm ms-2" id="updatePhoneBtn">Cập Nhật</button>
                                @else
                                    <h6 class="m-0">Số điện thoại: {{ Auth::user()->so_dien_thoai }}</h6>
                                @endif
                            </div>
                        </div>
                    @else
                        {{-- Nếu chưa đăng nhập thì hiển thị form người đặt hàng --}}
                        <div class="bg-white p-3 mb-3 infoUserPay" style="border-radius: 20px;">
                            <h6 class="fw-bold titlecontentUser">Người đặt hàng</h6>
                            <div class="form-person-order">
                                @error('ho_ten_VL')
                                    <small class="text-danger ms-2">{{$message}}</small>
                                @enderror
                                <input type="text" class="form-control mb-2" placeholder="Họ và tên (*)" name="ho_ten_VL" value="{{old('ho_ten_VL')}}">
                                @error('so_dien_thoai_VL')
                                    <small class="text-danger ms-2">{{$message}}</small>
                                @enderror
                                <input type="text" class="form-control mb-2" placeholder="Số điện thoại (*)" pattern="[0-9]*"  title="Vui lòng nhập số" name="so_dien_thoai_VL" value="{{old('so_dien_thoai_VL')}}">
                                
                                <input type="text" class="form-control" placeholder="Email (*)" name="email_VL" value="{{ old('email_VL') }}">
                            </div>
                        </div>
                    @endif
                    
                    {{-- Hình thức nhận hàng (cả chưa đăng nhập và đã đăng nhập) --}}
                    <div class="bg-white p-3 mb-3" style="border-radius: 20px">
                        <h6 class="fw-bold ">Địa chỉ nhận hàng</h6>
                        <div class="row">
                            <div class="col-4">
                                <label for="province" class="fw-bold fst-italic">Tỉnh/Thành Phố</label>
                                <select name="province" id="province"  class="form-control">
                                    <option value="">Chọn Tỉnh/Thành Phố</option>
                                    @foreach($province as $prov)
                                        <option value="{{ $prov->province_id }}">{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_VL')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="district" class="fw-bold fst-italic">Quận/Huyện</label>
                                <select name="district" id="district"  class="form-control">
                                    <option value="">Chọn Quận/Huyện</option>
                                </select>
                                @error('district_VL')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="ward_VL" class="fw-bold fst-italic">Phường/Xã</label>
                                <select name="ward" id="ward"  class="form-control">
                                    <option value="">Chọn Phường/Xã</option>
                                </select>
                                @error('ward')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                            <input type="text" class="form-control mt-3" name="address_detail" placeholder="Địa chỉ chi tiết" value="{{old('address_detail')}}">
                            @error('address_detail')
                                    <small class="text-danger">{{$message}}</small>
                            @enderror
                        <div class="row">
                            <div class="col-12 mt-3">
                                <textarea placeholder="Ghi chú (ví dụ: Hãy gọi tôi khi chuẩn bị hàng xong)" class="form-control" rows="4" name="note"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Xuất hóa đơn điện tử --}}
                    <div class="bg-white p-3 mb-3 d-flex align-items-center justify-content-between" style="border-radius: 20px;">
                        <h6 class="fw-bold m-0">Xuất hóa đơn điện tử</h6>
                        <label class="switch">
                            <input type="checkbox" name="electronic_bill">
                            <span class="slider"></span>
                        </label>
                    </div>

                    {{-- Lựa chọn thanh toán --}}
                    
                    <div class="bg-white p-3 mb-3" style="border-radius: 20px;">
                        <h6 class="fw-bold m-0">Phương thức thanh toán</h6>
                        @error('payment_method')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div class="pay-item-cash mb-2">
                            <input type="radio" name="payment_method" id="cash" style="width: 20px" class="custom-radio" value="cash">
                            <img src="https://s3-sgn09.fptcloud.com/ict-payment-icon/payment/cod.png?w=48&q=100" alt="" style="width: 60px">
                            <label for="cash">Thanh toán khi nhận hàng</label>
                        </div>
                        <div class="pay-item-vnpay mb-2">
                            <input type="radio" name="payment_method" id="vnpay" style="width: 20px" class="custom-radio" value="vnpay">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp1v7T287-ikP1m7dEUbs2n1SbbLEqkMd1ZA&s" alt="" style="width: 60px">
                            <label for="vnpay">Thanh toán bằng ví VN-PAY</label>
                        </div>
                        <div class="pay-item-momo mb-2">
                            <input type="radio" name="payment_method" id="momo" style="width: 20px" class="custom-radio" value="momo">
                            <img src="https://s3-sgn09.fptcloud.com/ict-payment-icon/payment/momo.png?w=48&q=100" alt="" style="width: 60px">
                            <label for="momo">Thanh toán bằng ví MOMO</label>
                        </div>
                    </div>
                    
                </div>
                <div class="bg-white p-3" style="border-radius: 20px;position:sticky; top: 70px; height: 400px;box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
                    {{-- THÔNG TIN ĐƠN HÀNG --}}
                    @if(Auth::check())
                        <h6 class="fw-bold" style="margin-bottom: 10px">Thông tin đơn hàng</h6>
                        <div class="total-price d-flex justify-content-between border-bottom">
                            <h6>Tổng tiền</h6>
                            <h6 style="font-size: 20px; font-weight: bold">{{number_format($totalPrice,0,',','.')}}đ</h6>
                        </div>

                        {{-- Tổng khuyến mãi --}}
                        <div class="total-promotion mt-3 d-flex justify-content-between">
                            <h6>Tổng khuyến mãi</h6>
                            <h6 style="font-size: 17px">0đ</h6>
                        </div>

                        {{-- Phí vẫn chuyển --}}
                        <div class="shipping mt-3 d-flex justify-content-between border-bottom">
                            <h6>Phí vận chuyển</h6>
                            <h6 style="font-size: 17px">Miễn phí</h6>
                        </div>

                        {{-- Cần thanh toán --}}
                        <div class="shipping mt-3 d-flex justify-content-between border-bottom">
                            <h6>Cần thanh toán</h6>
                            <input type="hidden" value="{{intval(str_replace('.', '',  $totalPrice)) }}" name="total_pay">
                            <h6 style="font-size: 20px;color:red; font-weight: bold;">{{number_format($totalPrice,0,',','.')}}đ</h6>

                        </div>
                    @else
                        <h6 class="fw-bold" style="margin-bottom: 10px">Thông tin đơn hàng</h6>
                        <div class="total-price d-flex justify-content-between border-bottom">
                            <h6>Tổng tiền</h6>
                            <h6 style="font-size: 20px; font-weight: bold">{{Cart::total()}}đ</h6>
                        </div>

                        {{-- Tổng khuyến mãi --}}
                        <div class="total-promotion mt-3 d-flex justify-content-between">
                            <h6>Tổng khuyến mãi</h6>
                            <h6 style="font-size: 17px">0đ</h6>
                        </div>

                        {{-- Phí vẫn chuyển --}}
                        <div class="shipping mt-3 d-flex justify-content-between border-bottom">
                            <h6>Phí vận chuyển</h6>
                            <h6 style="font-size: 17px">Miễn phí</h6>
                        </div>

                        {{-- Cần thanh toán --}}
                        <div class="shipping mt-3 d-flex justify-content-between border-bottom">
                            <h6>Cần thanh toán</h6>
                            <input type="hidden" value="{{intval(str_replace('.', '',  Cart::total())) }}" name="total_pay">
                            <h6 style="font-size: 20px;color:red; font-weight: bold;">{{ Cart::total() }}đ</h6>

                        </div>
                    @endif
                    {{-- BTN Đặt Hàng --}}
                    <button type="submit" class="btn btn-danger mt-3 w-100">ĐẶT HÀNG</button>
                    <div class="dieukhoan mt-3">
                        <h6 class="text-center" style="font-size: 13px">Bằng việc tiến hành đặt mua hàng, bạn đồng ý với </br>
                        <a href="" style="color:green">Điều khoản dịch vụ</a> và <a href="" style="color:green">Chính sách xử lý dữ liệu cá nhân</a> </br>
                            của Gia Dụng Văn Hậu</h6>
                    </div>
                </div>
            </div>
        </form>
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
        .infoUserPay:hover {
            transition: all .5s;
            box-shadow: 0 0 10px 0 rgba(0,0,0,.1);
            background-color: rgba(0, 0, 0, 0.1);
        }
        .titlecontentUser {
            transition: all .4s ease;
        }
        .infoUserPay:hover .titlecontentUser {
            color: red;
        }
    </style>
@endsection
