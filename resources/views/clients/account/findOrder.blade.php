@extends('layouts.client')
@section('title','TRA CỨU HÓA ĐƠN')
@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="mx-auto">
                <h2 class="text-center fw-bold">TRA CỨU ĐƠN HÀNG</h2>
                <form action="" class="border rounded p-3" method="GET">
                    @csrf
                    <input type="number" placeholder="Nhập số điện thoại để tra cứu hóa đơn..." value="{{ request('so_dien_thoai') }}" class="form-control" min="1" name="so_dien_thoai">
                    <input type="submit" value="TRA CỨU ĐƠN HÀNG" class="btn btn-primary btn-sm mt-3 text-center">
                </form>
                @if(!empty($orders) && count($orders) > 0)
                    <h3 class="mt-4">DANH SÁCH HÓA ĐƠN</h3>
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>STT</th>
                                <th>Tên Người Đặt</th>
                                <th>Ngày Đặt</th>
                                <th>Tổng Tiền</th>
                                <th width="200px">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 0;
                            @endphp
                            @foreach($orders as $order)
                            @php
                                $num++;
                            @endphp
                            <tr>
                                <td>{{$num}}</td>
                                <td>{{$order->ho_ten}}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
                                <td>{{ number_format($order->tong_tien, 0, ',', '.') }}đ</td>
                                <td>
                                    @if($order->trang_thai == 1)
                                        <h6 class=" py-1 bg-success rounded text-center text-white">Đã giao</h6>
                                    @elseif($order->trang_thai == 2)
                                        <h6 class=" py-1 bg-warning rounded text-center text-white">Đang giao</h6>
                                    @elseif($order->trang_thai == 3)
                                        <h6 class=" py-1 bg-primary rounded text-center text-white">Đã xác nhận đơn</h6>
                                    @else
                                        <h6 class=" py-1 bg-danger rounded text-center text-white">Đang xử lý</h6>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $orders->links() }}
                    </div>
                @else
                    <h4 class="mt-4">KHÔNG TÌM THẤY HÓA ĐƠN</h4>
                @endif
            </div>
            
            
            
        </div>
    </div>
</div>
@endsection