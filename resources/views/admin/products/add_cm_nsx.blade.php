@extends('layouts.admin')

@section('title')
    Thêm Nhà Sản Xuất Mới
@endsection

@section('content-admin')
<div class="container mt-5">
    <div class="row justify-content-between mb-3" style="margin-top: -30px">
        <div class="col-auto">
            <a href="{{ route('getadd_product') }}" class="btn btn-primary">Quay Lại</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('getadd_product') }}" class="btn btn-secondary me-2">Thêm sản phẩm</a>
            <a href="{{route('getadd_nsx')}}" class="btn btn-secondary me-2">Thêm Nhà Sản Xuất</a>
            <a href="{{route('getadd_dm')}}" class="btn btn-secondary me-2">Thêm Danh Mục</a>
            <a href="{{route('getadd_cm')}}" class="btn btn-secondary me-2">Thêm Chuyên Mục</a>
            <a href="{{route('getadd_cm_nsx')}}" class="btn btn-danger me-2">Thêm CM cho NSX</a>
        </div>
    </div>
    
    <div class="card shadow-sm col-md-12">
        <div class="card-body">
            <form action="{{-- route('admin.store_product') --}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger text-center" id="error-message">
                        @foreach($errors->all() as $error)
                            <span>{{ $error }}</span><br>
                        @endforeach
                        Vui lòng kiểm tra lại dữ liệu
                    </div>
                @endif
                @if(session('msg'))
                    <div class="alert alert-success text-center">
                        {{session('msg')}}
                    </div>
                @endif
                <div class="row">
                    <div class="mb-3">
                        <label for="maNSX" class="form-label">Nhà Sản Xuất:</label>
                        <select name="maNSX" id="maNSX" class="form-control">
                            <option value="">Chọn nhà sản xuất</option>
                            @if(!empty(getAllNSX()))
                                @foreach(getAllNSX() as $item)
                                    <option value="{{$item->maNSX}}" {{request()->maNSX == $item->maNSX ? 'selected' : ''}}>{{$item->ten_NSX}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('maNSX')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_danh_muc" class="form-label">Danh Mục:</label>
                        <select name="id_danh_muc" id="id_danh_muc" class="form-control">
                            @if(!empty(getAllDanhMucSp2()))
                                @foreach(getAllDanhMucSp2() as $item)
                                    <option value="{{$item->id_danh_muc}}" {{request()->id_danh_muc == $item->id_danh_muc ? 'selected' : ''}}>{{$item->ten_danh_muc}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('id_danh_muc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="id_chuyen_muc" class="form-label">Chuyên mục:</label>
                        <select name="id_chuyen_muc" id="id_chuyen_muc" class="form-control">
                            @if(!empty(getAllChuyenMucSp()))
                                @foreach(getAllChuyenMucSp() as $item)
                                    <option value="{{$item->id_chuyen_muc}}" {{request()->id_chuyen_muc == $item->id_chuyen_muc ? 'selected' : ''}}>{{$item->ten_chuyen_muc}}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('id_chuyen_muc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Thêm Chuyên Mục NSX</button>
            </form>
        </div>
    </div>

    <!-- Bảng hiển thị Nhà Sản Xuất và Chuyên Mục -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="text-center">Danh Sách Nhà Sản Xuất và Chuyên Mục</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nhà Sản Xuất</th>
                        @if(!empty(getAllDanhMucSp2()))
                            @foreach(getAllDanhMucSp2() as $danhMuc)
                                <th>{{$danhMuc->ten_danh_muc}}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if(!empty(getAllNSX()))
                        @foreach(getAllNSX() as $nsx)
                            <tr>
                                <td>{{$nsx->ten_NSX}}</td>
                                @if(!empty(getAllDanhMucSp2()))
                                    @foreach(getAllDanhMucSp2() as $danhMuc)
                                        <td>
                                            @php
                                                // Kiểm tra xem nhà sản xuất này có chuyên mục nào thuộc danh mục không
                                                $chuyenMucCount = getChuyenMucCountByNSXAndDanhMuc($nsx->maNSX, $danhMuc->id_danh_muc);
                                            @endphp
                                            @if($chuyenMucCount > 0)
                                                <span class="text-success">{{$chuyenMucCount}} chuyên mục</span>
                                            @else
                                                <span class="text-danger">Không có</span>
                                            @endif
                                        </td>
                                    @endforeach
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100%" class="text-center">Không có dữ liệu nhà sản xuất</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
