@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
<link rel="stylesheet" href="{{asset('assets/admin/css/custom_show.css')}}">
@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container-fluid"> <!-- Changed to container-fluid -->
        <div class="text-center mb-4 fw-bold d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid me-2" style="width: 40px; height: 35px;">
            <h1 id="title-top" class="ms-3" style="font-size: 22px">{{$title}}</h1>
        </div>
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="align-middle">
                    <th style="width:3%;"><a href="">STT</a></th>
                    <th><a href="">Người đăng</a></th>
                    <th><a href="">Loại KH</a></th>
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
                        <td>
                            @if($item->ho_ten)
                                {{$item->ho_ten}}
                            @else
                                {{$item->ho_ten_KHVL}}
                            @endif
                        </td>
                        <td>
                            @if($item->ho_ten == null)
                                <span class="text-danger">KH VÃNG LAI</span>
                            @else
                            <span class="text-success">Khách Hàng</span>
                            @endif
                        </td>
                        <td>
                            <a target="_blank" href="{{route('home.chi_tiet_sp',$item->slug)}}" style="text-decoration: none; color: black">
                                {!! \Illuminate\Support\Str::limit($item->ten_san_pham,20) !!}
                            </a>
                        </td>
                        <td>
                                {!! \Illuminate\Support\Str::limit($item->noi_dung,20) !!}
                        </td>
                        <td>
                            @if($item->trang_thai == 1 || $item->trang_thai == 2)
                                <span class="bg-success p-2 rounded text-white">Đã Duyệt</span>
                            @else
                                <span class="bg-danger p-2 rounded text-white">Chưa Duyệt</span>
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
                            {{-- <a href="route('info', ['id'=>$item->username])" class="btn btn-info btn-sm">Xem</a> --}}
                            <a href="{{route('admin.comments.edit', ['id'=>$item->id])}}" class="btn btn-warning btn-sm">Xem</a>
                            <form action="{{ route('admin.comments.delete', $item->id) }}" method="POST" style="display:inline; "id="delete-form-{{$key}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-product" data-form="delete-form-{{$key}}">Xóa</button>
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
    document.querySelectorAll('.delete-product').forEach(button => {
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
