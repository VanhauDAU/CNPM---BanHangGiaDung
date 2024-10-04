@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
<link rel="stylesheet" href="{{asset('assets/admin/css/custom_show.css')}}">
@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container-fluid"> <!-- Changed to container-fluid -->
        <div class="text-center mb-4 fw-bold d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid me-2" style="width: 50px; height: 45px;">
            <h1 id="title-top" class="ms-3">{{$title}}</h1>
        </div>
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="" method="get" class="mb-3 border-top pt-3">
            <div class="row align-items-center">
                <div class="col-sm-1">
                    <label for="keyword" class="d-flex align-items-center">
                        <i class="fa-solid fa-filter me-2" style="font-size:20px;"></i>
                        <h4 class="mb-0 fs-6">Bộ Lọc</h4>
                    </label>
                </div>
                {{-- <div class="col-sm-2">
                    <select class="form-select" name="chuc_vu" id="chuc_vu">
                        <option value="0">Người đăng</option>
                        @if(!empty(getAllUserPost()))
                            @foreach(getAllUserPost() as $item)
                                <option value="{{$item->user_id}}" {{request()->chuc_vu == $item->user_id ? 'selected' : ''}}>{{$item->ho_ten}}</option>
                            @endforeach
                        @endif
                    </select>
                </div> --}}
                {{-- <div class="col-sm-3">
                    <input type="search" class="form-control" name="keyword" id="keyword" placeholder="Nhập tìm kiếm..." value="{{request()->keyword}}">
                </div> --}}
                <div class="col-sm-2">
                    <button class="btn btn-primary btn-block" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="align-middle">
                    <th style="width:3%;"><a href="">STT</a></th>
                    <th><a href="">Người đăng</a></th>
                    <th><a href="">Sản phẩm</a></th>
                    <th><a href="">Nội dung</a></th>
                    <th><a href="">Trạng thái</a></th>
                    <th><a href="">Ngày bình luận</a></th>
                    <th style="width: 200px;"><a href="">Hành động</a></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($commentList))
                    @foreach ($commentList as $key => $item)
                    <tr class="align-middle">
                        <td>{{$key + 1}}</td>
                        <td>{{$item->ho_ten}}</td>
                        <td>
                            {{$item->ten_san_pham}}
                            {{-- {!! \Illuminate\Support\Str::limit($item->tieu_de,30) !!} --}}
                        </td>
                        <td>{{$item->noi_dung}}</td>
                        <td>
                            @if($item->trang_thai == 1)
                                Đã Duyệt
                            @else
                                Chưa Duyệt
                            @endif
                        </td>
                        <td>
                            @if(empty($item->created_at))
                                <i class="fa-solid fa-xmark"></i>
                            @else
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td>
                            {{-- <a href="{{ route('info', ['id'=>$item->username]) }}" class="btn btn-info btn-sm">Xem</a> --}}
                            <a href="{{-- route('getedit_post', ['id'=>$item->id_bai_viet]) --}}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{--route('getdelete_post',['id'=>$item->id_bai_viet]) --}}" method="POST" style="display:inline;" id="delete-form-{{$key}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-user" data-form="delete-form-{{$key}}">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="7" class="text-center">KHÔNG CÓ BÌNH LUẬN NÀO</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{$commentList->links()}}
        </div>  
    </div>
</div>
<script>
</script>
@endsection
