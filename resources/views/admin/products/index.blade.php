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
        {{-- @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif --}}

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
                        <option value="0">--Nhà Sản Xuất--</option>
                        @if(!empty(getAllNSX()))
                            @foreach(getAllNSX() as $item)
                                <option value="{{$item->maNSX}}" {{request()->nsx == $item->maNSX ? 'selected' : false }}>{{$item->ten_NSX}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="id_danh_muc" id="id_danh_muc" onchange="fetchChuyenMuc(this.value)">
                        <option value="0">--Danh mục--</option>
                        @if(!empty(getAllDanhMucSp()))
                            @foreach(getAllDanhMucSp() as $item)
                                <option value="{{$item->id_danh_muc}}" {{request()->id_danh_muc == $item->id_danh_muc ? 'selected' : false }}>{{$item->ten_danh_muc}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-sm-2">
                    <select class="form-select" name="id_chuyen_muc" id="id_chuyen_muc" >
                        <option value="0">--Chuyên mục--</option>
                    </select>
                </div>
                <div class="col-sm-2">
                    <input type="search" class="form-control" name="keyword" id="keyword" placeholder="Nhập tìm kiếm..." value="{{request()->keyword}}">
                </div>
                <div class="col-sm-2">
                    <button class="btn btn-primary w-100">Tìm kiếm</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="3%">STT</th>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>NSX</th>
                    <th>Loại</th>
                    <th>Giá</th>
                    <th>Views</th>
                    <th>Loại</th>
                    <th>Ẩn/Hiện</th>
                    <th width="200px">Chức Năng</th>
                </tr>
            </thead>
            <tbody class="tbody-listsp">
                @if(!empty($ProductList))
                    @foreach ($ProductList as $key => $item)
                    {{-- {{dd($ProductList)}} --}}
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            <img src="{{asset('storage/products/img/'.$item->anh)}}" alt="" style="width: 50px">
                        </td>   
                        <td>
                            <a href="{{route('home.chi_tiet_sp',$item->slug)}}"  class="text-sp-hover">
                               {{ \Illuminate\Support\Str::limit($item->ten_san_pham,40)}}
                            </a>
                        </td>
                        <td>{{$item->ten_NSX}}</td>
                        <td>{{$item->ten_danh_muc}}</td>
                        <td>{{number_format($item->don_gia,0,',','.')}} VNĐ</td>
                        <td>{{$item->luot_xem}}</td>
                        <td>
                            @if($item->sp_noi_bat == 1)
                                <h6 class="text-center bg-success p-1 border rounded text-white p-1">Nổi Bật</h6>
                            @else
                                <h6 class="text-center bg-secondary p-1 border rounded text-white p-1">Thường</h6>
                            @endif
                        </td>
                        <td>
                            @if($item->trang_thai == 1)
                                <h6 class="text-center bg-success p-1 border rounded text-white p-1">Hiển thị</h6>
                            @else
                                <h6 class="text-center bg-secondary p-1 border rounded text-white p-1">Ẩn</h6>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('product.info', ['id'=>$item->maSP]) }}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('postedit_product', $item->maSP) }}" class="btn btn-warning btn-sm">Sửa</a>
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
                        <td colspan="9" class="text-center">KHÔNG CÓ SẢN PHẨM</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{$ProductList->links()}}
        </div>  
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('id_chuyen_muc').addEventListener('change', function() {
            const selectedValue = this.value;
            console.log("Selected Chuyen Muc ID: ", selectedValue); 
        });
    });
    function fetchChuyenMuc(idDanhMuc) {
        console.log("Fetching Chuyen Muc for idDanhMuc: ", idDanhMuc); // Debug log
        if (idDanhMuc) {
            fetch(`/getChuyenMuc/${idDanhMuc}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("Data fetched: ", data); // Debug log
                    const chuyenMucSelect = document.getElementById('id_chuyen_muc');
                    chuyenMucSelect.innerHTML = '<option value="">Chọn chuyên mục</option>';

                    data.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id_chuyen_muc;
                        option.textContent = category.ten_chuyen_muc;
                        chuyenMucSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Lỗi:', error));
        } else {
            document.getElementById('id_chuyen_muc').innerHTML = '<option value="">Chọn chuyên mục</option>';
        }
    }

    // Thêm sự kiện change cho trường select chuyên mục
    document.getElementById('id_chuyen_muc').addEventListener('change', function() {
        const selectedValue = this.value; // Giá trị được chọn
        console.log("Selected Chuyen Muc ID: ", selectedValue); // In ra giá trị được chọn
    });
</script>

@endsection
