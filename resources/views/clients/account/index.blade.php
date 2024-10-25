@extends('layouts.client')
@section('title')
    {{ Auth::user()->ho_ten }} - {{$title}}
@endsection

@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="col-md-3">
                @include('clients.blocks.categoriesUser')
            </div>
            <div class="col-md-9 mx-auto">
                <div class="col-md-7 user-details mt-5" style="margin: 0 auto;">
                    <h5 class="mb-4 text-uppercase font-weight-bold running-text text-center">Thông tin tài khoản</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Họ tên:</strong> <span>{{ Auth::user()->ho_ten }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Điện thoại:</strong> <span>{{ Auth::user()->so_dien_thoai }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Email:</strong> <span>{{ Auth::user()->email }} 
                                {{-- {{dd(Auth::user()->email_verified_at)}} --}}
                                @if(Auth::user()->email_verified_at == null)
                                    <i class="fa-solid fa-x"></i>
                                    <form action="{{ route('verification.resend') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0">Xác thực ngay</button>
                                    </form>
                                    
                                @else
                                    <span style="color: green"><i class="fa-solid fa-check"></i> Đã xác thực </span>
                                @endif
                            </span>
                            
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Ngày sinh:</strong> 
                            <span>
                                @if(Auth::user()->ngay_sinh == "")
                                    Chưa có thông tin
                                @else
                                    {{\Carbon\Carbon::parse(Auth::user()->ngay_sinh)->format('d-m-Y')}}
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Giới tính:</strong> 
                            @if(Auth::user()->gioi_tinh == "")
                                Chưa có thông tin
                            @else
                                @if(Auth::user()->gioi_tinh == 1)
                                    Nam
                                @elseif(Auth::user()->gioi_tinh == 0)
                                    Nữ
                                @else
                                    Khác
                                @endif
                            @endif
                        </li>
                    </ul>
                    <a href="{{route('home.account.info-user.edit')}}" type="submit" class="btn btn-primary col-12 mt-3" style="display: block;background-color:#DA251C; border-color:#DA251C;">Cập nhật thông tin</a>
                </div>
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
</style>
@endsection
