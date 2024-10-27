<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipped</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f6fa;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            color: #555;
        }
        .header {
            background-color: #4E9F3D;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 140px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            text-align: center;
            color: white;
            text-transform: uppercase;
        }
        .content {
            padding: 20px;
        }
        .section-title {
            color: #4E9F3D;
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid #4E9F3D;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
            color: #333;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #eaeaea;
        }
        th {
            background-color: #f0f5f3;
            color: #333;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .footer {
            background-color: #4E9F3D;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <img src="https://i.imgur.com/alKWkWB.png" alt="Logo">
            <h1>Hóa Đơn Điện Tử</h1>
        </div>

        <!-- Order Information Section -->
        <div class="content">
            <h2 class="section-title">Thông tin đơn hàng</h2>
            <table>
                <tr>
                    <th>Mã Hóa Đơn</th>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <th>Tên Khách Hàng</th>
                    <td>{{ Auth::check() ? $order->user->ho_ten : $order->ho_ten }}</td>
                </tr>
                <tr>
                    <th>Số Điện Thoại</th>
                    <td>{{ Auth::check() ? $order->user->so_dien_thoai : $order->so_dien_thoai }}</td>
                </tr>
                <tr>
                    <th>Địa Chỉ Nhận Hàng</th>
                    <td>{{$order->dia_chi}}, {{$order->ward->name}}, {{$order->district->name}}, {{$order->province->name}}</td>
                </tr>
                @if(!empty($order->ghi_chu))
                <tr>
                    <th>Ghi Chú</th>
                    <td>{{$order->ghi_chu}}</td>
                </tr>
                @endif
                <tr>
                    <th>Thời Gian Đặt Hàng</th>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <!-- Product Details Section -->
        <div class="content">
            <h2 class="section-title">Chi tiết sản phẩm</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Số Lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listProduct as $product)
                    <tr>
                        <td>{{$product->ten_san_pham}}</td>
                        <td>{{$product->so_luong}}</td>
                        <td>{{ number_format($product->gia, 0, ',', '.') }} VND</td>
                        <td>{{ number_format($product->so_luong * $product->gia, 0, ',', '.') }} VND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Summary Section -->
        <div class="content">
            <h2 class="section-title">Tổng kết đơn hàng</h2>
            <table>
                <tr>
                    <th>Tổng tiền sản phẩm</th>
                    <td>{{ number_format($order->tong_tien, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>Phí vận chuyển</th>
                    <td>0đ</td>
                </tr>
                <tr>
                    <th>Tổng cộng</th>
                    <td>{{ number_format($order->tong_tien, 0, ',', '.') }} VND</td>
                </tr>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Cảm ơn bạn đã mua sắm tại {{ config('app.name') }}! Nếu bạn có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi.</p>
        </div>
    </div>
</body>
</html>
