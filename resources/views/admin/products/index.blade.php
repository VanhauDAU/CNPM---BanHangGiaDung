@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="text-center mb-4 fw-bold d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid" style="width: 50px; height: 45px;">
            <h1 id="title-top" class="ms-3">{{$title}}</h1>
        </div>
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('getadd_product') }}" class="btn btn-primary">Thêm sản phẩm</a>
        </div>

        <form action="" method="get" class="mb-3 border-top pt-3">
            <div class="row align-items-center">
                <div class="col-sm-1">
                    <label for="keyword" class="d-flex align-items-center">
                        <i class="fa-solid fa-filter" style="font-size:20px; margin-right: 10px;"></i>
                        <h4 class="mb-0 fs-6">Bộ Lọc</h4>
                    </label>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="nsx" id="nsx">
                        <option value="0">Nhà Sản Xuất</option>
                        @if(!empty(getAllNSX()))
                            @foreach(getAllNSX() as $item)
                                <option value="{{$item->maNSX}}" {{request()->maNSX == $item->maNSX ? 'selected' : false }}>{{$item->maNSX}} - {{$item->ten_NSX}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="nhomSP" id="nhomSP">
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
                    <button class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
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
                            <a href="{{-- route('users.edit', $item->id) --}}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('getdelete_product', $item->maSP) }}" method="POST" style="display:inline; "id="delete-form-{{$key}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-product" data-form="delete-form-{{$key}}">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="7" class="text-center">KHÔNG CÓ SẢN PHẨM</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('js')
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
