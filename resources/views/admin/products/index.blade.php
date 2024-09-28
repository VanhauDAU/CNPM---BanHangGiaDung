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
        <div class="text-center mb-4 fw-bold" style="display: flex; justify-content:center; align-items:center;">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid" style="width: 50px; height: 45px;">
            <h1 id="title-contentAdmin">{{$title}}</h1>
        </div>
        <div class="d-flex justify-content-between">
            {{-- <a href="{{ route('admin.dashboard') }}" class="btn back-btn">Quay lại</a> --}}
        </div>
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <a href="{{ route('getadd_product') }}" class="btn custom-btn">Thêm sản phẩm</a>
        </div>
        <form action="" method="get" style="margin-top: 16px; margin-bottom: -8px; border-top: 1px solid #ccc;padding-top: 10px">
            <div class="row align-items-center">
                <div class="col-sm-1 align-items-center" >
                    <label for="keyword" style="display:flex; align-items:center;">
                        <i class="fa-solid fa-filter" style="font-size:20px; margin-right: 10px;"></i>
                        <h4 style="margin-top:8px">Bộ Lọc</h4>
                    </label>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="nsx" id="nsx">
                        <option value="0">Nhà Sản Xuất</option>
                        @if(!empty(getAllNSX()))
                            @foreach(getAllNSX() as $item)
                                <option value="{{$item->maNSX}}" {{request()->maNSX == $item->maNSX ? 'selected' : false }}>{{$item->maNSX}} - {{$item->ten_NSX}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-control" name="nhomSP" id="nhomSP">
                        <option value="0">Nhóm Sản Phẩm</option>
                        @if(!empty(getAllDanhMucSp()))
                            @foreach(getAllDanhMucSp() as $item)
                                <option value="{{$item->nhomSP}}" {{request()->nhom_sp == $item->nhomSP ? 'selected' : false }}>{{$item->nhomSP}} - {{$item->ten_nhom}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="search" class="form-control" name="keyword" id="keyword" placeholder="Nhập tìm kiếm..." value="{{request()->keyword}}">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-primary btn-block" style="margin:0;">Tìm kiếm</button>
                </div>
            </div>
        </form>
        {{-- <x-package-alert/> --}}
        <table class="table table-bordered">
            <thead">
                <tr>
                    <th width="3%">STT</th>
                    <th>Mã SP</th>
                    <th>Mã NSX</th>
                    <th>Loại</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th width="200px">Chức Năng</th>
                </tr>
            </thead>
            <tbody class="tbody-listsp">
                @if(!empty($ProductList))
                    @foreach ($ProductList as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->maSP}}</td>
                        <td>{{$item->maNSX}}</td>
                        <td>{{$item->ten_nhom}}</td>
                        <td>{{$item->ten_san_pham}}</td>
                        <td>{{number_format($item->don_gia,0,',','.')}} VNĐ</td>
                        <td>
                            <a href="{{ route('product.info', ['id'=>$item->maSP]) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{-- route('users.edit', $item->id) --}}" class="btn btn-danger btn-sm">Sửa</a>
                            <form action="{{-- route('users.destroy', $item->id) --}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="9">KHÔNG CÓ SẢN PHẨM</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
