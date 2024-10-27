@extends('layouts.client')

@section('title', 'Thanh toán thành công')
@section('content-clients')
<div class="main-home-pay">
    <div class="container pay mt-3" style="padding: 52px 0px 0px; min-height: 100vh"> 
        <!-- Breadcrumb -->
        <div class="row path p-2 d-flex align-items-center mb-3" style="background-color: white; border-radius: 20px;">
            <h6 class="m-0">
                <a href="{{ route('home.index') }}"><i class="fa-solid fa-house"></i></a> > 
                <a href="#" style="color: blue">Thanh toán</a> > 
                <a href="#" style="color: blue">Thành công</a>
            </h6>
        </div>
        <div class="d-grid" style="grid-template-columns: 1fr 0.9fr; gap:33px;">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 text-center" style="background-color: white; border-radius: 20px; padding: 40px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);">
                    <i class="fa-solid fa-circle-check" style="color: green; font-size: 70px; margin-bottom: 20px;"></i>
                    <h2 class="mb-3">Thanh toán thành công!</h2>
                    <p>Cảm ơn bạn đã mua hàng! Đơn hàng của bạn đã được thanh toán thành công.</p>
                    <p>Bạn có thể xem chi tiết trong <a href="{{route('home.account.myOrder')}}" style="color: #1E88E5">Đơn hàng của tôi</a></p>
                    <a href="{{ route('home.products.index') }}" class="btn btn-primary mt-3">Tiếp tục mua sắm</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="border-radius: 20px;">
                        <div class="card-header text-center" style="background-color: #007bff; color: white; border-radius: 20px 20px 0 0;">
                            <h5>Thông tin đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            @php
                                use Carbon\Carbon;
                                $formattedDate = Carbon::createFromFormat('YmdHis', $payDate)->format('d/m/Y H:i:s');
                            @endphp
                            <p><strong>Mã giao dịch:</strong> {{ $transactionNo }}</p>
                            <p><strong>Số tiền:</strong> {{ number_format($amount, 0, ',', '.') }} VND</p>
                            <p><strong>Ngày thanh toán:</strong>{{$formattedDate}} </p>
                            <p><strong>Phương thức thanh toán:</strong> {{ $phuongthuc }}</p>
                            <p><strong>Trạng thái giao dịch:</strong> {{ $transactionStatus == '00' ? 'Thành công' : 'Thất bại' }}</p>
                            <p><strong>Thông tin đơn hàng:</strong> {{ $orderInfo }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('stylesheet')
<style>
    .main-home-pay {
        background-color: #F3F4F6;
        width: 100%; 
        margin: 0 auto;
        padding: 5px;
    }
    .container.pay {
        width: 1470px;
        margin: 0 auto;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        border-radius: 30px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection
