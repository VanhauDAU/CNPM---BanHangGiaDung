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
            <a href="{{route('getadd_nsx')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Nhà Sản Xuất</a>
            <a href="{{route('getadd_dm')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Danh Mục</a>
            <a href="{{route('getadd_cm')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm Chuyên Mục</a>
            <a href="{{route('getadd_cm_nsx')}}" id="btn-add-nsx" class="btn btn-danger me-2">Thêm CM cho NSX</a>
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
                                    <option value="{{$item->maNSX}}" {{request()->maNSX = $item->maNSX ? 'selected' : false}}>{{$item->ten_NSX}}</option>
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
                                    <option value="{{$item->id_danh_muc}}" {{request()->id_danh_muc = $item->id_danh_muc ? 'selected' : false}}>{{$item->ten_danh_muc}}</option>
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
                                    <option value="{{$item->id_chuyen_muc}}" {{request()->id_chuyen_muc = $item->id_chuyen_muc ? 'selected' : false}}>{{$item->ten_chuyen_muc}}</option>
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
</div>

@endsection
