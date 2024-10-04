@extends('layouts.client')

@section('title')
    {{$title}}
@endsection

@section('content-clients')
<div class="container mt-1" style="padding: 56px 0px 0px;"> 
    <div class="main-products pt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Giỏ Hàng</h2>

                @if(session('cart') && count(session('cart')) > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Tên Sản Phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Thành Tiền</th>
                                <th scope="col">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(session('cart') as $id => $item)
                                <tr class="align-middle">
                                    <td>
                                        <a href="{{ route('home.chi_tiet_sp',$item['slug']) }}">
                                            <img src="{{asset('storage/products/img/'.$item['anh'])}}" alt="{{ $item['anh'] }}" style="width: 150px; height: auto;" class="rounded" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                        </a>
                                    </td>
                                    <td><a href="{{ route('home.chi_tiet_sp',$item['slug']) }}">{{ $item['ten_san_pham'] }}</a></td>
                                    <td>{{ number_format($item['don_gia'], 0, ',', '.') }} đ</td>
                                    {{-- <td>
                                        <input type="number" class="form-control" value="{{ $item['so_luong'] }}" min="1" onchange="updateCart({{ $id }}, this.value)">
                                    </td> --}}
                                    <td>
                                        <form action="{{ route('home.cart.update', $id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="so_luong" value="{{ $item['so_luong'] }}" min="1" max="100">
                                            <button type="submit" class="btn btn-success">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td>{{ number_format($item['don_gia'] * $item['so_luong'], 0, ',', '.') }} đ</td>
                                    <td>
                                        <form action="{{ route('home.cart.remove', $id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-6 offset-md-6">
                            <h5 class="text-right" style="font-size: 1.5rem; font-weight: bold;">Tổng tiền: <span id="total-price" style="color: #28a745;">{{ number_format(array_sum(array_map(function($item) { return $item['don_gia'] * $item['so_luong']; }, session('cart'))), 0, ',', '.') }} đ</span></h5>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <a href="{{-- route('home.checkout') --}}" class="btn btn-success btn-lg">Thanh Toán</a>
                            <a href="{{ route('home.products.index') }}" class="btn btn-danger btn-lg">Tiếp Tục Mua Sắm</a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning text-center">Giỏ hàng của bạn hiện đang trống.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
</script>
@endsection
