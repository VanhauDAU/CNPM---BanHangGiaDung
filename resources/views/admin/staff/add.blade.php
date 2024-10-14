
@extends('layouts.admin')

@section('title')
    Thêm Nhóm
@endsection

@section('content-admin')
<div class="container">
    <h1 class="text-center mb-4 fw-bold"><i class="fa-solid fa-plus"></i>Thêm Nhóm</h1>

    <form action="{{-- route('admin.add_user') --}}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
            <div class="alert alert-danger text-center" id="error-message">
                Vui lòng kiểm tra lại dữ liệu
            </div>
        @endif
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        
        <div class="row">
            <div class="mb-3">
                <label for="ten_chuc_vu">Tài Khoản <span style="color: red;">*</span></label>
                <input type="text" id="ten_chuc_vu" name="ten_chuc_vu" class="form-control" placeholder="Nhập tên nhóm..." value="{{old('ten_chuc_vu')}}">
                @error('ten_chuc_vu')
                        <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="margin-top: 30px;">Thêm Mới</button>
            <a href="{{route('admin.staffs.index')}}" class="btn btn-primary" style="margin-top:30px; background-color:orange; outline: none; border: none;">Quay Lại</a>
        </div>
    </form>
</div>

<script>
    function checkChucVu() {
        var chucVu = document.getElementById('chuc_vu').value;
        var hiddenAccountType = document.getElementById('hidden_account_type');

        if (chucVu == '4'||chucVu == '0') {
            hiddenAccountType.value = '0';
        } else {
            hiddenAccountType.value = '1';
        }
    }

    // Gọi hàm để kiểm tra khi trang được tải
    checkAccountType();
    checkChucVu();
</script>
@endsection
