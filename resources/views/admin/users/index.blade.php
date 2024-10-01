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
        {{-- @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif --}}

        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('getadd_user') }}" class="btn btn-primary">Thêm người dùng</a>
        </div>

        <form action="" method="get" class="mb-3 border-top pt-3">
            <div class="row align-items-center">
                <div class="col-sm-1">
                    <label for="keyword" class="d-flex align-items-center">
                        <i class="fa-solid fa-filter me-2" style="font-size:20px;"></i>
                        <h4 class="mb-0 fs-6">Bộ Lọc</h4>
                    </label>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="chuc_vu" id="chuc_vu">
                        <option value="0">Tất Cả Chức Vụ</option>
                        @if(!empty(getAllGroups()))
                            @foreach(getAllGroups() as $item)
                                <option value="{{$item->maCV}}" {{request()->chuc_vu == $item->maCV ? 'selected' : ''}}>{{$item->ten_chuc_vu}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-3">
                    <input type="search" class="form-control" name="keyword" id="keyword" placeholder="Nhập tìm kiếm..." value="{{request()->keyword}}">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-primary btn-block" type="submit">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width:3%;"><a href="">STT</a></th>
                    <th><a href="">Ảnh</a></th>
                    <th><a href="">Tài khoản</a></th>
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
                    <tr class="align-middle">
                        <td>{{$key + 1}}</td>
                        <td>
                            @if($item->provider=="google" && $item->updated_at != null)
                                <a href="{{ route('info', ['id'=>$item->username]) }}">
                                    <img src="{{$item->anh}}" alt="" style="width: 50px; height:50px; border-radius:50%" class="rounded-circle img-thumbnail border-animation1">
                                </a>
                            @else
                                <a href="{{ route('info', ['id'=>$item->username]) }}">
                                    @if(!empty($item->anh))
                                        <img src="{{asset('storage/users/img/'.$item->anh)}}" alt="" class="rounded-circle img-thumbnail border-animation1" style="width: 50px; height: 50px;">
                                    @else
                                        <i class="fa-solid fa-xmark"></i>  
                                    @endif
                                </a>
                            @endif
                        </td>
                        <td>
                            @if(empty($item->provider == "google"))
                                {{$item->username}}
                            @else   
                            <i class="fa-brands fa-google"></i>
                            @endif
                        </td>
                        <td>
                            @if(!empty($item->ten_chuc_vu == "Khách Hàng"))
                                <span class="text-center bg-success p-1 border rounded text-white">{{$item->ten_chuc_vu}}</span>
                            @elseif(!empty($item->ten_chuc_vu =="Giám Đốc"))
                                <span class="text-center bg-danger p-1 border rounded text-white ">{{$item->ten_chuc_vu}}</span>
                            @else
                                {{$item->ten_chuc_vu}}
                            @endif
                            
                        </td>
                        <td>{{$item->ho_ten}}</td>
                        <td>
                            @if(!empty($item->ngay_sinh)) 
                                {{ \Carbon\Carbon::parse($item->ngay_sinh)->format('d/m/Y')}}
                            @else
                                <i class="fa-solid fa-xmark"></i>    
                            @endif
                        </td>
                        <td>
                            @if(empty($item->so_dien_thoai))
                                <i class="fa-solid fa-xmark"></i>
                            @else
                                {{$item->so_dien_thoai}}
                            @endif
                        </td>
                        <td>{{$item->email}}</td>
                        <td>
                            <a href="{{ route('info', ['id'=>$item->username]) }}" class="btn btn-info btn-sm">Xem</a>
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
                    <td colspan="8" class="text-center">KHÔNG CÓ NGƯỜI DÙNG</td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
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
