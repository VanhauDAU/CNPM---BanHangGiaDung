<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\clients\Payment;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function index(){
        $title = 'Trang Thanh Toán';
        return view('clients.Payment.index', compact('title'));
    }
    public function postPayment(Request $request){
        // dd($request);
        if(!Auth::check()){
            $request->validate([
                'ho_ten_VL' => 'required|min:5',
                'so_dien_thoai_VL' => 'required|min:8',
                'province_VL' => 'required',
                'district_VL' => 'required',
                'ward_VL' => 'required',
                'address_detail' => 'required',
                'payment_method' => 'required',
            ], [
                'ho_ten_VL.required' => 'Họ tên bắt buộc phải nhập.',
                'ho_ten_VL.min' => 'Họ tên phải có ít nhất 5 ký tự.',
                'so_dien_thoai_VL.required' => 'Số điện thoại bắt buộc phải nhập.',
                'so_dien_thoai_VL.min' => 'Số điện thoại phải có ít nhất 8 ký tự.',
                'province_VL.required' => 'Vui lòng chọn tỉnh.',
                'district_VL.required' => 'Vui lòng chọn huyện.',
                'ward_VL.required' => 'Vui lòng chọn xã.',
                'address_detail.required' => 'Vui lòng nhập địa chỉ chi tiết.',
                'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            ]);   
            $bill = new Payment();
            $bill->username = "KHVL";
            $bill->ho_ten = $request->ho_ten_VL;
            $bill->email = $request->email;
            $bill->tong_tien = $request->total_pay;
            $bill->thanhpho_tinh = $request->province_VL;
            $bill->quan_huyen = $request->district_VL;
            $bill->phuong_xa = $request->ward_VL;
            $bill->so_dien_thoai = $request->so_dien_thoai_VL;
            $bill->dia_chi = $request->address_detail;
            $bill->phuongthuc = $request->payment_method;
            $bill->ghi_chu = $request->note;
            $bill->save();
            $newBillId = $bill->id;
            $sum_bill  = $bill->tong_tien;
        }
        if($request->payment_method == "vnpay"){
            return $this->vnpay_payment($newBillId, $sum_bill);
        }else{
            return redirect()->back();
        }
    }
    public function vnpay_payment($billId,$sum_bill){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://localhost/vnpay_php/vnpay_return.php";
        $vnp_TmnCode = "TKZTII2P";
        $vnp_HashSecret = "TJOXMKTU0GDL2UH4UEMG02TSDDX0Y10T";
        
        $vnp_TxnRef = $billId;
        $vnp_OrderInfo = "Thanh Toán Hóa Đơn";
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
