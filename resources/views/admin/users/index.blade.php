@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
<link rel="stylesheet" href="{{asset('assets/admin/css/custom_show.css')}}">
@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container1">
        <div class="text-center mb-4 fw-bold" style="display: flex; justify-content:center; align-items:center;">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid" style="width: 50px; height: 45px;">
            <h1 id="title-contentAdmin">{{$title}}</h1>
        </div>
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <a href="{{ route('getadd_user') }}" class="btn custom-btn">Thêm người dùng</a>
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
                    <select class="form-control" name="chuc_vu" id="chuc_vu">
                        <option value="0">Tất Cả Chức Vụ</option>
                        @if(!empty(getAllGroups()))
                            @foreach(getAllGroups() as $item)
                                <option value="{{$item->maCV}}" {{request()->chuc_vu == $item->maCV ? 'selected' : false }}>{{$item->ten_chuc_vu}}</option>
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
                    <th style="width:3%;"><a href="">STT</a></th>
                    <th><a href="">Tên TK</a></th>
                    <th><a href="">Nhóm</a></th>
                    <th><a href="?sort-by=ho_ten&sort-type={{$sortType}}">Họ Tên</a></th>
                    <th><a href="?sort-by=ngay_sinh&sort-type={{$sortType}} ">Ngày Sinh</a></th>
                    <th><a href="">SĐT</a></th>
                    <th><a href="?sort-by=email&sort-type={{$sortType}}">Email</a></th>
                    {{-- <th><a href="">Địa Chỉ</a></th> --}}
                    <th style="width: 200px;"><a href="">Chức năng</a></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($userList))
                    @foreach ($userList as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->username}}</td>
                        <td>{{$item->ten_chuc_vu}}</td>
                        <td>{{$item->ho_ten}}</td>
                        <td>
                            @if (!is_null($item->ngay_sinh))
                                {{ \Carbon\Carbon::parse($item->ngay_sinh)->format('d/m/Y') }}
                            @else
                                <i class="fa-solid fa-xmark"></i>
                            @endif
                        </td>
                        <td>
                            @if (!is_null($item->so_dien_thoai))
                                {{$item->so_dien_thoai}}
                            @else  
                                <i class="fa-solid fa-xmark"></i>
                            @endif
                        </td>
                        <td>{{$item->email}}</td>
                        {{-- <td>{{ Str::limit($item->dia_chi, 30, '...') }}</td> --}}
                        <td>
                            <a href="{{ route('info', ['id'=>$item->username]) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('getedit_user', ['id'=>$item->username]) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{route('getdelete_user',['id'=>$item->username]) }}" method="POST" style="display:inline;" id="delete-form-{{$key}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-user" data-form="delete-form-{{$key}}">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                @else
                <tr>
                    <td colspan="7" class="text-center">KHÔNG CÓ NGƯỜI DÙNG</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div style="display: flex; justify-content: center; height: 20px; font-size: 20px;">
            {{$userList->links()}}
        </div>        
        
    </div>
</div>

<script>
    document.querySelectorAll('.delete-user').forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();
        const formId = event.target.getAttribute('data-form');
        const form = document.getElementById(formId);
        
        Swal.fire({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "Bạn sẽ không thể hoàn tác điều này!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

</script>

@endsection

    
