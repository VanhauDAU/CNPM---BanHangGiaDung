@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/css/custom_show.css')}}">
@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container1">
        <h1>{{$title}}</h1>
    
        <div class="d-flex justify-content-between">
            {{-- <a href="{{ route('admin.dashboard') }}" class="btn back-btn">Quay lại</a> --}}
        </div>
        {{-- <x-package-alert/> --}}
        <table class="table table-bordered">
            <thead">
                <tr>
                    <th width="5%">STT</th>
                    <th width="10%">Mã HĐ</th>
                    <th width="10%">Mã SP</th>
                    <th width="5%">SL</th>
                    <th>Tổng</th>
                    <th width="20%">Địa chỉ nhận hàng</th>
                    <th width="20%">Mã KH</th>
                    <th width="20%">CHỨC NĂNG</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($OrderList))
                    @foreach ($OrderList as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->maHDDH}}</td>
                        <td>{{$item->maSP}}</td>
                        <td>{{$item->so_luong_mua}}</td>
                        <td>{{$item->tong_tien}}</td>
                        <td>{{$item->dia_chi_nhan_hang}}</td>
                        <td>{{$item->maKH}}</td>
                        <td>
                            <a href="{{-- route('users.edit', $item->id) --}}" class="btn btn-sm">Sửa</a>
                            <form action="{{-- route('users.destroy', $item->id) --}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="6">KHÔNG CÓ HÓA ĐƠN</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
