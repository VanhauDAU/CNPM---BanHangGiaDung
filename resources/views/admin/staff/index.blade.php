@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
<link rel="stylesheet" href="{{asset('assets/admin/css/custom_show.css')}}">
@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container-fluid"> <!-- Changed to container-fluid -->
        <div class="text-center mb-4 fw-bold d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid me-2" style="width: 40px; height: 45px;">
            <h1 id="title-top" class="ms-3" style="font-size: 22px">{{$title}}</h1>
        </div>
        {{-- @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif --}}

        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.staffs.add') }}" class="btn btn-primary">Thêm Nhóm</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width:3%;"><a href="">STT</a></th>
                    <th><a href="">Tên</a></th>
                    <th style="width: 10%"><a href="">Người Đăng</a></th>
                    <th style="width: 200px;"><a href="">Phân Quyền</a></th>
                    <th style="width: 200px;"><a href="">Hành động</a></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($lists))
                    @foreach ($lists as $key => $item)
                    <tr class="align-middle">
                        <td>{{$key + 1}}</td>
                        <td  class="text-start">{{$item->ten_chuc_vu}}</td>
                        <td  class="text-start">{{!empty($item->postBy->ho_ten) ?$item->postBy->ho_ten : false}}</td>
                        <td><a href="{{route('admin.staffs.phanQuyen',$item->maCV)}}" class="btn btn-primary">Phân Quyền</a></td>
                        <td>
                            <a href="{{ route('admin.staffs.edit', ['staff'=>$item->maCV]) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{route('admin.staffs.delete',['staff'=>$item->maCV]) }}" method="POST" style="display:inline;" id="delete-form-{{$key}}">
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
            {{-- {{$userList->links()}} --}}
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
