@extends('layouts.admin')

@section('title')
    {{$title}}
@endsection

@section('content-admin')
<div class="wrapper wrapper-content">
    <div class="container">
        <div class="text-center mb-1 fw-bold d-flex justify-content-center align-items-center">
            <img src="{{asset('assets/general/img/logoDAU.png')}}" alt="" class="img-fluid" style="width: 40px; height: 45px;">
            <h1 id="title-top" class="ms-3" style="font-size: 22px">{{$title}}</h1>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <a href="{{ route('admin.promotions.add') }}" class="btn btn-primary">Thêm khuyến mãi</a>
        </div>
        @if(session('msg'))
            <div class="alert alert-success text-center">
                {{session('msg')}}
            </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th width="3%">STT</th>
                    <th>Mã KM</th>
                    <th>Tên KM</th>
                    <th>Loại KM</th>
                    <th>Ngày Bắt Đầu</th>
                    <th>Ngày Kết Thúc</th>
                    <th>SL Còn</th>
                    <th>Trạng Thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="tbody-listsp">
                @if(!empty($AllPromotions) && count($AllPromotions) > 0)
                    @foreach ($AllPromotions as $key => $item)
                    {{-- {{dd($ProductList)}} --}}
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>
                            {{$item->ma_khuyen_mai}}
                        </td>   
                        <td>
                            <a href="{{--route('home.chi_tiet_sp',$item->slug)--}}"  class="text-sp-hover">
                               {{ \Illuminate\Support\Str::limit($item->ten_khuyen_mai,15)}}
                            </a>
                        </td>
                        <td>{{$item->loai_khuyen_mai}}</td>
                        <td>
                            {{\Carbon\Carbon::parse($item->ngay_bat_dau)->format('d-m-Y H:i:s')}}
                        </td>
                        <td>{{\Carbon\Carbon::parse($item->ngay_ket_thuc)->format('d-m-Y H:i:s')}}</td>
                        <td>{{$item->so_luong_su_dung}}</td>
                        <td>
                            @if($item->trang_thai == 0 && now() <= $item->ngay_ket_thuc && now() >= $item->ngay_bat_dau)
                                <span class="bg-success p-1 rounded text-white">Kích Hoạt</span>
                            @elseif($item->trang_thai == 1 || now() >= $item->ngay_ket_thuc)
                                <span class="bg-danger p-1 rounded text-white">Không Kích Hoạt</span>
                            @endif

                        </td>
                        <td>
                            <a href="{{-- route('admin.products.detailProduct', ['id'=>$item->maSP]) --}}" class="btn btn-primary btn-sm">Xem</a>
                            <a href="{{ route('admin.promotions.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.promotions.delete', $item->id) }}" method="POST" style="display:inline; "id="delete-form-{{$key}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-product" data-form="delete-form-{{$key}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center">KHÔNG CÓ KHUYẾN MÃI</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{-- {{$ProductList->links()}} --}}
        </div>  
    </div>
</div>
@endsection
@section('js')
<script>
</script>
@endsection
