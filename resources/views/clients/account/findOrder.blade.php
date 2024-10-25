@extends('layouts.client')
@section('title','TRA CỨU HÓA ĐƠN')
@section('content-clients')
<div class="main-posts">
    <div class="container mt-1" style="padding: 70px 0px 0px; min-height: 100vh">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="fw-bold">TRA CỨU ĐƠN HÀNG</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="number" placeholder="Nhập số điện thoại để tra cứu hóa đơn..." value="{{ request('so_dien_thoai') }}" class="form-control" min="1" name="so_dien_thoai">
                                <button type="submit" class="btn btn-primary btn-sm">TRA CỨU ĐƠN HÀNG</button>
                            </div>
                        </form>
                        @if(!empty($orders) && count($orders) > 0)
                            <h3 class="mt-4">DANH SÁCH HÓA ĐƠN</h3>
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="text-center" style="background-color: #DA251C; color:white">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Đơn</th>
                                        <th>Tên Người Đặt</th>
                                        <th>Ngày Đặt</th>
                                        <th>Tổng Tiền</th>
                                        <th>Trạng Thái</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $index => $order)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->ho_ten }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ number_format($order->tong_tien, 0, ',', '.') }} đ</td>
                                            <td>
                                                @if($order->trang_thai == 1)
                                                    <h6 class=" py-1 bg-success rounded text-center text-white">Đang giao</h6>
                                                @elseif($order->trang_thai == 2)
                                                    <h6 class=" py-1 bg-warning rounded text-center text-white">Hoàn tất</h6>
                                                @elseif($order->trang_thai == 3)
                                                    <h6 class=" py-1 bg-primary rounded text-center text-white">Đã hủy</h6>
                                                @elseif($order->trang_thai == 4)
                                                    <h6 class=" py-1 bg-danger rounded text-center text-white">Trả hàng</h6>
                                                @else
                                                    <h6 class=" py-1 bg-danger rounded text-center text-white">Đang xử lý</h6>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{-- route('orders.show', $order->id) --}}" class="btn btn-info btn-sm w-100">Xem Chi Tiết</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination d-flex justify-content-center">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="alert alert-warning mt-4" role="alert">
                                Không tìm thấy hóa đơn nào!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('stylesheetAccount')
<style>
    .main-posts{
        background-color: #F3F4F6;
    }
</style>
@endsection

