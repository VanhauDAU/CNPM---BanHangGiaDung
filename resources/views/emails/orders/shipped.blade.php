<x-mail::message>
# Cảm ơn bạn đã mua hàng của Gia Dụng Văn Hậu!

## Chi tiết hóa đơn

- **Mã Hóa Đơn:** {{$order->id}}
- **Tên Khách Hàng:** {{$order->ho_ten}}
- **Số Điện Thoại:** {{$order->so_dien_thoai}}
- **Địa Chỉ Nhận Hàng:** 
  {{$order->dia_chi}}, 
  {{$order->ward->name}}, 
  {{$order->district->name}}, 
  {{$order->province->name}}

@if(!empty($order->ghi_chu))
- **Ghi Chú:** {{$order->ghi_chu}}
@endif

- **Thời Gian Mua Hàng:** {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i') }}

---
CHI TIẾT HÓA ĐƠN

Cảm ơn bạn đã tin tưởng và lựa chọn chúng tôi! Nếu bạn có bất kỳ câu hỏi nào, đừng ngần ngại liên hệ với chúng tôi.

<br>
{{ config('app.name') }}
</x-mail::message>
