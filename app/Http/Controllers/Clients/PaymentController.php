<?php

namespace App\Http\Controllers\clients;

use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use App\Models\admin\products;
use App\Models\clients\Payment;
use App\Models\admin\ShoppingCart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\admin\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\clients\ShoppingCartDetail;

class PaymentController extends Controller
{
    //
    public function index(){
        $title = 'Trang Thanh Toán';
        $province = DB::table('province')->get();
        $district = DB::table('district')->get();
        $ward = DB::table('wards')->get();
        $products = ShoppingCart::where('user_id', Auth::id())->with('products')->get();
        $totalPrice = $products->sum(function($item) {
            return $item->price * $item->qty;
        });
        return view('clients.Payment.index', compact('title','province','district','ward','products','totalPrice'));
    }
    public function postPayment(Request $request){
        if($request->total_pay == 0){
            toastr()->warning('Kiểm tra lại', 'Giỏ hàng của bạn đang trống');
            return redirect()->back();
        }
        if(!Auth::check()){
            $request->validate([
                'ho_ten_VL' => 'required|min:5',
                'email_VL' => 'required',
                'so_dien_thoai_VL' => 'required|min:8',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'address_detail' => 'required',
                'payment_method' => 'required',
            ], [
                'ho_ten_VL.required' => 'Họ tên bắt buộc phải nhập.',
                'email_VL'=>'Email bắt buộc phải nhập',
                'ho_ten_VL.min' => 'Họ tên phải có ít nhất 5 ký tự.',
                'so_dien_thoai_VL.required' => 'Số điện thoại bắt buộc phải nhập.',
                'so_dien_thoai_VL.min' => 'Số điện thoại phải có ít nhất 8 ký tự.',
                'province.required' => 'Vui lòng chọn tỉnh.',
                'district.required' => 'Vui lòng chọn huyện.',
                'ward.required' => 'Vui lòng chọn xã.',
                'address_detail.required' => 'Vui lòng nhập địa chỉ chi tiết.',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            ]);   
                $order = new Payment();
                $order->user_id = "KHVL";
                $order->ho_ten = $request->ho_ten_VL;
                $order->email = $request->email_VL;
                $order->tong_tien = $request->total_pay;
                $order->province_id = $request->province;
                $order->district_id = $request->district;
                $order->wards_id = $request->ward;
                $order->so_dien_thoai = $request->so_dien_thoai_VL;
                $order->dia_chi = $request->address_detail;
                $order->phuongthuc = $request->payment_method;
                $order->ghi_chu = $request->note;
                $order->save();
                $newBillId = $order->id;
                $sum_bill  = $order->tong_tien;
            foreach (Cart::content() as $item) {
                $billDetail = new ShoppingCartDetail();
                $billDetail->id_don_hang = $newBillId;
                $billDetail->maSP = $item->id;
                $billDetail->so_luong = $item->qty;
                $billDetail->gia = $item->price;
                $billDetail->tong_tien_sp = $item->price * $item->qty;
                $billDetail->save();
            }
            $listProduct = ShoppingCartDetail::where('id_don_hang', $newBillId)
            ->join('sanpham', 'chitietdonhang.maSP', '=', 'sanpham.maSP')
            ->get();
            Mail::to($request->email_VL)->send(new OrderShipped($order,$listProduct));
        }else{
            $request->validate([
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
                'address_detail' => 'required',
                'payment_method' => 'required',
            ], [
                'province.required' => 'Vui lòng chọn tỉnh.',
                'district.required' => 'Vui lòng chọn huyện.',
                'ward.required' => 'Vui lòng chọn xã.',
                'address_detail.required' => 'Vui lòng nhập địa chỉ chi tiết.',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            ]);   
            $order = new Payment();
            $order->user_id = Auth::id();
            $order->tong_tien = $request->total_pay;
            $order->province_id = $request->province;
            $order->district_id = $request->district;
            $order->wards_id = $request->ward;
            $order->dia_chi = $request->address_detail;
            $order->phuongthuc = $request->payment_method;
            $order->ghi_chu = $request->note;
            $order->save();
            $newBillId = $order->id;
            $sum_bill  = $order->tong_tien;
            $listProduct = ShoppingCart::where('user_id', Auth::id())->get();
            foreach ($listProduct as $item) {
                // dd($item);
                $billDetail = new ShoppingCartDetail();
                $billDetail->id_don_hang = $newBillId;
                $billDetail->maSP = $item->maSP;
                $billDetail->so_luong = $item->qty;
                $billDetail->gia = $item->price;
                $billDetail->tong_tien_sp = $item->price * $item->qty;
                $billDetail->save();
            }
            $listProduct = ShoppingCartDetail::where('id_don_hang', $newBillId)
            ->join('sanpham', 'chitietdonhang.maSP', '=', 'sanpham.maSP')
            ->get();
            Mail::to(Auth::user()->email)->send(new OrderShipped($order,$listProduct));
        }

        
        if($request->payment_method == "vnpay"){
            return $this->vnpay_payment($newBillId, $sum_bill);
        }elseif($request->payment_method == "cash"){
            return redirect()->route('home.pay.done');
        }else{
            return redirect()->back();
        }
        
    }
    public function done() {
        if(!Auth::check()){
            Cart::destroy();
            return view('clients.Payment.successful_cash');
        }else{
            ShoppingCart::where('user_id', Auth::id())->delete();
            return view('clients.Payment.successful_cash');
        }
        
        return view('clients.Payment.successful');
    }
    public function doneVNPay() {
        // Trích xuất thông tin từ URL
        $amount = request()->get('vnp_Amount');
        $phuongthuc = "VN-Pay";
        $bankCode = request()->get('vnp_BankCode');
        $orderInfo = request()->get('vnp_OrderInfo');
        $payDate = request()->get('vnp_PayDate');
        $transactionNo = request()->get('vnp_TransactionNo');
        $transactionStatus = request()->get('vnp_TransactionStatus');
        $amount = $amount / 100;
        Cart::destroy();
        return view('clients.Payment.successful', compact(
            'amount', 'bankCode', 'orderInfo', 'payDate', 'transactionNo', 'transactionStatus','phuongthuc'
        ));
    }   
      
    public function vnpay_payment($billId,$sum_bill){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/thanh-toan/vn_pay/payment_successful";

        $vnp_TmnCode = "TKZTII2P";
        $vnp_HashSecret = "TJOXMKTU0GDL2UH4UEMG02TSDDX0Y10T";
        
        $vnp_TxnRef = $billId;
        $vnp_OrderInfo = "Thanh Toán Hóa Đơn Gia Dụng Văn Hậu";
        $vnp_OrderType = "Gia Dụng Văn Hậu";
        $vnp_Amount =  $sum_bill * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        return redirect($vnp_Url);
    }
}
