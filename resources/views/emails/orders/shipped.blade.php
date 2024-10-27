<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipped</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 150px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .order-details, .product-details {
            margin: 20px 0;
        }
        .order-details table, .product-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-details th, .order-details td, .product-details th, .product-details td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .order-details th, .product-details th {
            background-color: #f4f4f4;
        }
        .footer {
            text-align: center;
            padding: 20px 0;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://i.imgur.com/alKWkWB.png" alt="Logo">
            <h1>Chi tiết hóa đơn</h1>
        </div>

        <div class="order-details">
            <table>
                <tr>
                    <th>Mã Hóa Đơn</th>
                    <td>{{$order->id}}</td>
                </tr>
                <tr>
                    <th>Tên Khách Hàng</th>
                    <td>{{$order->ho_ten}}</td>
                </tr>
                <tr>
                    <th>Số Điện Thoại</th>
                    <td>{{$order->so_dien_thoai}}</td>
                </tr>
                <tr>
                    <th>Địa Chỉ Nhận Hàng</th>
                    <td>
                        {{$order->dia_chi}}, 
                        {{$order->ward->name}}, 
                        {{$order->district->name}}, 
                        {{$order->province->name}}
                    </td>
                </tr>
                @if(!empty($order->ghi_chu))
                <tr>
                    <th>Ghi Chú</th>
                    <td>{{$order->ghi_chu}}</td>
                </tr>
                @endif
                <tr>
                    <th>Thời Gian Mua Hàng</th>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="product-details">
            <h2>Chi tiết sản phẩm</h2>
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
                    {{-- @foreach($order->products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{$product->pivot->quantity}}</td>
                        <td>{{ number_format($product->pivot->price, 0, ',', '.') }} VND</td>
                        <td>{{ number_format($product->pivot->quantity * $product->pivot->price, 0, ',', '.') }} VND</td>
                    </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        <div class="order-summary">
            <h2>Tổng kết đơn hàng</h2>
            <table>
                <tr>
                    <th>Tổng tiền sản phẩm</th>
                    <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                </tr>
                <tr>
                    <th>Phí vận chuyển</th>
                    {{-- <td>{{ number_format($order->shipping_fee, 0, ',', '.') }} VND</td> --}}
                </tr>
                <tr>
                    <th>Tổng cộng</th>
                    {{-- <td>{{ number_format($order->total + $order->shipping_fee, 0, ',', '.') }} VND</td> --}}
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Cảm ơn bạn đã tin tưởng và lựa chọn chúng tôi! Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với chúng tôi.</p>
            <br>
            <p>{{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>