<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\admin\products;
use App\Models\admin\ShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function index()
    {
        $title = 'GIỎ HÀNG';
        return view('clients.shoppingCart.index', compact('title'));
    }
    public function add(Request $request,$id)
    {
        $title ='Giỏ Hàng';
        $product = products::with(['danhMuc', 'nhaSanXuat'])->find($id);
        // Cart::destroy();
        if($product->so_luong_ton < $request->so_luong){
            return redirect()->back()->with('warning','Số lượng tồn kho không đủ');
        }
        Cart::add([
            'id' => $product->maSP,
            'name' => $product->ten_san_pham, 
            'qty' => $request->so_luong,
            'price' => $product->don_gia,
            'options' => [
                'slug' => $product->slug,
                'anh'=>$product->anh,
                'ten_danh_muc'=> $product->danhMuc->ten_danh_muc,
                'ten_NSX'=> $product->nhaSanXuat->ten_NSX,
                'added_at' => now(),
            ]
        ]);
        if ($request->input('action') === 'buy_now') {
            return redirect()->route('home.cart.index');
        }
        return redirect()->back()->with('success','Đã Thêm Sản Phẩm Vào Giỏ Hàng');
    }
    public function remove($rowId){
        Cart::remove($rowId);
        return redirect()->back()->with('success','Xóa sản phẩm thành công');
    }
    public function destroy(){
        Cart::destroy();
        return redirect()->back()->with('success','Đã xóa toàn bộ giỏ hàng');
    }
    public function update(Request $request){
        // dd($request->all());
        $data = $request->get('qty');
        foreach($data as $k => $v){
            Cart::update($k, $v);
        }
        return redirect()->back()->with('success','Cập nhật giỏ hàng thành công!');
    }


    
}
