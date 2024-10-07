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
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="{{route('posts.delete-any')}}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa')">
            @csrf
        <div class="d-flex mb-2">
            <a href="{{ route('getadd_post') }}" class="btn btn-primary">Thêm bài viết</a>
            <button type="submit" class="btn btn-danger">Xóa (0)</button>
        </div>

        {{-- <form action="" method="get" class="mb-3 border-top pt-3">
            <div class="row align-items-center">
                <div class="col-sm-1">
                    <label for="keyword" class="d-flex align-items-center">
                        <i class="fa-solid fa-filter me-2" style="font-size:20px;"></i>
                        <h4 class="mb-0 fs-6">Bộ Lọc</h4>
                    </label>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="chuc_vu" id="chuc_vu">
                        <option value="0">Người đăng</option>
                        @if(!empty(getAllUserPost()))
                            @foreach(getAllUserPost() as $item)
                                <option value="{{$item->user_id}}" {{request()->chuc_vu == $item->user_id ? 'selected' : ''}}>{{$item->ho_ten}}</option>
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
        </form> --}}
        
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th style="width:3%;"><a href="">STT</a></th>
                    <th><a href="">Ảnh</a></th>
                    <th><a href="">Tiêu đề</a></th>
                    <th><a href="">Ngày đăng</a></th>
                    <th><a href="">Ngày cập nhật</a></th>
                    <th width="15%"><a href="">Trạng thái</a></th>
                    <th ><a href="">Hành động</a></th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($PostList))
                    @foreach ($PostList as $key => $item)
                    <tr class="align-middle">
                        <td>
                            <input type="checkbox" name="delete[]" value="{{$item->id_bai_viet}}">
                        </td>
                        <td>{{$key + 1}}</td>
                        <td><img src="{{asset('storage/posts/img/'.$item->anh_bia)}}" alt="" style="width: 100px">
                        </td>
                        <td>
                            {!! \Illuminate\Support\Str::limit($item->tieu_de,30) !!}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y')}}
                        </td>
                        <td>
                            @if(empty($item->updated_at))
                                <i class="fa-solid fa-xmark"></i>
                            @else
                                {{ \Carbon\Carbon::parse($item->updated_at)->format('d/m/Y')}}
                            @endif
                        </td>
                        <td>
                            <div class="trangthai d-flex align-items-center justify-content-between" style="gap: 10px;">
                                
                                @if($item->trashed())
                                    <div class="btn btn-danger text-center col-12" style="min-width: 100px;">Đã xóa</div>
                                @else
                                    @if($item->trang_thai == 0)
                                        <h6 class="btn btn-danger col-12" >ẨN</h6>
                                    @else
                                        <h6 class="btn btn-success col-12">HIỆN</h6>
                                    @endif
                                @endif
                            </div>
                        </td>
                        
                        <td>
                            {{-- <a href="{{ route('info', ['id'=>$item->username]) }}" class="btn btn-info btn-sm">Xem</a> --}}
                            
                            @if($item->trashed())
                                <a href="{{ route('posts.restore', $item) }}" class="btn btn-primary btn-sm">Khôi phục</a>
                                <a href="{{ route('posts.force-delete', $item) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn?')">Xóa vĩnh viễn</a>
                            @else
                                <a href="{{ route('getedit_post', ['id'=>$item->id_bai_viet]) }}" class="btn btn-warning btn-sm col-8">Sửa</a>
                            @endif
                            
                            {{-- <form action="{{route('getdelete_post',['id'=>$item->id_bai_viet]) }}" method="POST" style="display:inline;" id="delete-form-{{$key}}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-user" data-form="delete-form-{{$key}}">Xóa</button>
                            </form> --}}
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
        </form>
        <div class="d-flex justify-content-center mt-3">
            {{-- {{$PostList->links()}} --}}
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
document.addEventListener('DOMContentLoaded', function() {
    const checkAllBox = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('input[name="delete[]"]');
    const deleteButton = document.querySelector('button[type="submit"]');
    function updateDeleteButton() {
        const checkedCount = document.querySelectorAll('input[name="delete[]"]:checked').length;
        deleteButton.innerHTML = `Xóa (${checkedCount})`;
    }
    checkAllBox.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = checkAllBox.checked;
        });
        updateDeleteButton();
    });
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                checkAllBox.checked = false;
            } else if (document.querySelectorAll('input[name="delete[]"]:checked').length === checkboxes.length) {
                checkAllBox.checked = true;
            }
            updateDeleteButton();
        });
    });
});

</script>
@endsection
