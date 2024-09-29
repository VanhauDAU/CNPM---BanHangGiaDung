@extends('layouts.admin')

@section('title')
    Thông tin {{$userDetail->ho_ten}}
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Cột thông tin chung -->
        <div class="col-md-4">
            <div class="card border-1 card-info-user">
                <div class="card-header text-white text-center">
                    <h3 class="card-title running-text m-0">THÔNG TIN CHUNG</h3>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $userDetail->anh ?? 'https://via.placeholder.com/150' }}" alt="Avatar" class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px;">
                    <h4 class="text-primary"><strong>{{ $userDetail->loai_tai_khoan == 0 ? 'KHÁCH HÀNG' : 'NHÂN VIÊN' }}</strong></h4>
                    <p class="text-muted">{{ $userDetail->ho_ten }}</p>
                    <div class="social-icons mt-3">
                        <a href="{{--$userDetail->facebook --}}" class="btn btn-outline-light btn-sm me-1 bg-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{-- $userDetail->tiktok --}}" class="btn btn-outline-light btn-sm me-1 bg-tiktok" target="_blank"><i class="fab fa-tiktok"></i></a>
                        <a href="{{-- $userDetail->telegram --}}" class="btn btn-outline-light btn-sm me-1 bg-telegram" target="_blank"><i class="fab fa-telegram-plane"></i></a>
                        <a href="{{-- $userDetail->instagram --}}" class="btn btn-outline-light btn-sm me-1 bg-instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="{{-- $userDetail->youtube --}}" class="btn btn-outline-light btn-sm me-1 bg-youtube" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="{{-- $userDetail->linkedin --}}" class="btn btn-outline-light btn-sm me-1 bg-linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột thông tin chi tiết -->
        <div class="col-md-8">
            <div class="card shadow border-0 mb-3">
                <div class="card-header text-white" style="background-color: #012E40">
                    <h4 class="card-title m-0">THÔNG TIN CHI TIẾT</h4>
                </div>
                <div class="card-body">
                    <p><strong>Tài khoản: </strong>{{ $userDetail->username }}</p>
                    <p><strong>Email: </strong>{{ $userDetail->email }}</p>
                    <p><strong>Chức vụ: </strong>{{ $userDetail->ten_chuc_vu }}</p>
                    <p><strong>CCCD: </strong>{{ $userDetail->cccd ?? 'Không xác định' }}</p>
                    <p><strong>Giới tính: </strong>
                        @if($userDetail->gioi_tinh === 1)
                            Nam
                        @elseif($userDetail->gioi_tinh === 0)
                            Nữ
                        @else
                            Không xác định
                        @endif
                    </p>
                    <p><strong>Điện thoại: </strong>{{ $userDetail->so_dien_thoai ?? 'Không xác định' }}</p>
                    <p><strong>Địa chỉ: </strong>{{ $userDetail->dia_chi ?? 'Không xác định' }}</p>
                    <p><strong>Ngày tạo TK: </strong>{{ \Carbon\Carbon::parse($userDetail->created_at)->format('d-m-Y H:i:s') }}</p>
                    <p><strong>Ngày cập nhật gần nhất: </strong>{{ \Carbon\Carbon::parse($userDetail->updated_at)->format('d-m-Y H:i:s') }}</p>
                </div>
            </div>

            <!-- Nút chỉnh sửa thông tin -->
            <div class="text-center mt-3">
                <a href="{{ route('getedit_user', ['id' => $userDetail->username]) }}" class="btn btn-primary btn-sm">Chỉnh Sửa Thông Tin</a>
                <a href="{{ route('admin.manage_user') }}" class="btn btn-danger btn-sm">Quay Lại</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('stylesheet')
    <style>
        .card-info-user{
            transition: all .5s ease;
            cursor: pointer;
            
        }
        .card-info-user:hover{
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            translate: 0px -5px;
        }
    </style>
@endsection
