<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\clients\shoppingCarts;
use Illuminate\Http\Request;
use app\Models\clients\shoppingCart;

class ShoppingCartController extends Controller
{
    //
    private $shoppingCarts;
    public $data=[];
    public function __construct()
    {
        
    }
    public function giohang(){
        $title ='GIỎ HÀNG';
        return view('clients.shoppingCart.index', compact('title'));
    }
}
