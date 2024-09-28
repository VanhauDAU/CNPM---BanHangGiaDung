@extends('layouts.admin')

@section('title')
    THÔNG TIN CÁ NHÂN
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
            <div class="panel panel-default">
                <div class="panel-heading bg-primary text-white text-center">
                    <h3 class="panel-title">THÔNG TIN CHUNG</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="{{ $adminInfo->anh ?? 'https://via.placeholder.com/150' }}" alt="Admin Avatar" class="img-circle img-thumbnail" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-primary running-text"><strong class="highlight">{{(($adminInfo->loai_tai_khoan) == 0 ? 'KHÁCH HÀNG' : 'ADMIN')}}</strong> - {{ $adminInfo->ho_ten }}</h4>
                            <p><strong>Tài khoản: </strong>{{ $adminInfo->username }}</p>
                            <p><strong>Email: </strong>{{ $adminInfo->email }}</p>
                            <p><strong>Chức vụ: </strong>{{ $adminInfo->ten_chuc_vu }}</p>
                            <div class="social-links mt-3">
                                <a href="{{-- $adminInfo->facebook --}}" target="_blank" class="btn btn-social-icon btn-facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{-- $adminInfo->tiktok --}}" target="_blank" class="btn btn-social-icon btn-tiktok"><i class="fab fa-tiktok"></i></a>
                                <a href="{{-- $adminInfo->telegram --}}" target="_blank" class="btn btn-social-icon btn-telegram"><i class="fab fa-telegram-plane"></i></a>
                                <a href="{{-- $adminInfo->instagram --}}" target="_blank" class="btn btn-social-icon btn-instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{-- $adminInfo->youtube --}}" target="_blank" class="btn btn-social-icon btn-youtube"><i class="fab fa-youtube"></i></a>
                                <a href="{{-- $adminInfo->linked --}}" target="_blank" class="btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Khung thông tin cá nhân -->
            <div class="panel panel-default mt-3">
                <div class="panel-heading bg-info text-white">
                    <h4 class="panel-title">Thông tin cá nhân</h4>
                </div>
                <div class="panel-body">
                    <p><strong>CCCD: </strong>{{ $adminInfo->cccd }}</p>
                    <p><strong>Giới tính: </strong>{{ ($adminInfo->gioi_tinh == 1 ? 'Nam' : 'Nữ') }}</p>
                    <p><strong>Điện thoại: </strong>{{ $adminInfo->so_dien_thoai }}</p>
                    <p><strong>Địa chỉ: </strong>{{ $adminInfo->dia_chi }}</p>
                    <p><strong>Ngày tạo TK: </strong>{{ \Carbon\Carbon::parse($adminInfo->created_at)->format('d-m-Y H:i:s') }}</p>
                    <p><strong>Ngày cập nhật gần nhất: </strong>{{ \Carbon\Carbon::parse($adminInfo->updated_at)->format('d-m-Y H:i:s') }}</p>
                </div>
                
            </div>

            <!-- Nút chỉnh sửa thông tin -->
            <div class="text-center mt-3">
                <a href="{{ route('getedit_user', ['id' => $adminInfo->username]) }}" class="btn btn-primary btn-sm">Chỉnh Sửa Thông Tin</a>
            </div>
        </div>
    </div>
</div>
@endsection
