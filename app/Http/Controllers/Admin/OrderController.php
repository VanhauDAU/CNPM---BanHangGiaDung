<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Orders;

class OrderController extends Controller
{
    //
    private $oders;
    public function __construct(){
        $this->oders = new Orders();
    }
    public $data=[];
    public function index(){
        return view('admin.dashboard.index');
    }
    //======================QUẢN LÝ HÓA ĐƠN=======================
    public function manage_order(){
        $title ='QUẢN LÝ ĐƠN ĐẶT HÀNG';
        $orders = new Orders();
        $OrderList = $orders->getAllOrders();
        return view('admin.orders.index',compact('title', 'OrderList'));
    }
    //======================KẾT THÚC QUẢN LÝ HÓA ĐƠN=======================
}
