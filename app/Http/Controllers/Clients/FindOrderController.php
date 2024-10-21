<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Orders;

class FindOrderController extends Controller
{
    public function index(Request $request){
        $so_dien_thoai = $request->query('so_dien_thoai');

        $orders = collect(); // Khởi tạo biến orders để không bị lỗi khi không có kết quả

        if ($so_dien_thoai) {
            // Lấy danh sách hóa đơn nếu có số điện thoại
            $orders = Orders::where('so_dien_thoai', $so_dien_thoai)
                            ->paginate(3)
                            ->appends(['so_dien_thoai' => $so_dien_thoai]);
        }

        return view('clients.account.findOrder', compact('orders'));
    }
}
