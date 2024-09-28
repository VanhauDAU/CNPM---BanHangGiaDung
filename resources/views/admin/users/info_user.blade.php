@extends('layouts.admin')

@section('title')
    Thông tin {{$userDetail->ho_ten}}
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
                            <img src="{{ $userDetail->anh ?? 'https://via.placeholder.com/150' }}" alt="Admin Avatar" class="img-circle img-thumbnail" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            <h4 class="text-primary running-text"><strong class="highlight">{{(($userDetail->loai_tai_khoan) == 0 ? 'KHÁCH HÀNG' : 'NHÂN VIÊN')}}</strong> - {{ $userDetail->ho_ten }}</h4>
                            <p><strong>Tài khoản: </strong>{{ $userDetail->username }}</p>
                            <p><strong>Email: </strong>{{ $userDetail->email }}</p>
                            <p><strong>Chức vụ: </strong>{{ $userDetail->ten_chuc_vu }}</p>
                            <div class="social-links mt-3">
                                <a href="{{--$userDetail->facebook --}}" target="_blank" class="btn btn-social-icon btn-facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{-- $userDetail->tiktok --}}" target="_blank" class="btn btn-social-icon btn-tiktok"><i class="fab fa-tiktok"></i></a>
                                <a href="{{-- $userDetail->telegram --}}" target="_blank" class="btn btn-social-icon btn-telegram"><i class="fab fa-telegram-plane"></i></a>
                                <a href="{{-- $userDetail->instagram --}}" target="_blank" class="btn btn-social-icon btn-instagram"><i class="fab fa-instagram"></i></a>
                                <a href="{{-- $userDetail->youtube --}}" target="_blank" class="btn btn-social-icon btn-youtube"><i class="fab fa-youtube"></i></a>
                                <a href="{{-- $userDetail->linked --}}" target="_blank" class="btn btn-social-icon btn-linkedin"><i class="fab fa-linkedin-in"></i></a>
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
                    <p><strong>CCCD: </strong>
                        @if(!empty($userDetail->cccd))
                            {{$userDetail->cccd}}
                        @else
                            Không xác định
                        @endif
                    </p>
                    <p><strong>Giới tính: </strong>
                        @if($userDetail->gioi_tinh === 1)
                            Nam
                        @elseif($userDetail->gioi_tinh === 0)
                            Nữ
                        @else
                            Không xác định
                        @endif
                    </p>
                    <p><strong>Điện thoại: </strong>
                        @if(!empty($userDetail->so_dien_thoai))
                            {{$userDetail->so_dien_thoai}}
                        @else
                            Không xác định
                        @endif
                    </p>
                    <p><strong>Địa chỉ: </strong>
                        @if(!empty($userDetail->dia_chi))
                            {{$userDetail->dia_chi}}
                        @else
                        Không xác định
                        @endif
                    </p>
                    <p><strong>Ngày tạo TK: </strong>{{ \Carbon\Carbon::parse($userDetail->created_at)->format('d-m-Y H:i:s') }}</p>
                    <p><strong>Ngày cập nhật gần nhất: </strong>{{ \Carbon\Carbon::parse($userDetail->updated_at)->format('d-m-Y H:i:s') }}</p>
                </div>
                
            </div>

            <!-- Nút chỉnh sửa thông tin -->
            <div class="text-center mt-3">
                <a href="{{ route('getedit_user', ['id' => $userDetail->username]) }}" class="btn btn-primary btn-sm">Chỉnh Sửa Thông Tin</a>
                <a href="{{route('admin.manage_user')}}" class="btn btn-danger btn-sm">Quay Lại</a>
                
            </div>
        </div>
    </div>
</div>
@endsection
