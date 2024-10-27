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
        $products = ShoppingCart::where('user_id', Auth::id())->with('products')->get();
        $totalPrice = $products->sum(function($item) {
            return $item->price * $item->qty;
        });
        return view('clients.shoppingCart.index', compact('title', 'products','totalPrice'));
    }
    public function add(Request $request, $id){
        $title = 'Giỏ Hàng';
        $product = products::with(['danhMuc', 'nhaSanXuat'])->find($id);
        if ($product->so_luong_ton < $request->so_luong) {
            return redirect()->back()->with('warning', 'Số lượng tồn kho không đủ');
        }
        if (Auth::check()) {
            $userId = Auth::id();
            $cartItem = ShoppingCart::where('user_id', $userId)->where('maSP', $product->maSP)->first();
            if ($cartItem) {
                $cartItem->qty += $request->so_luong;
                $cartItem->save();
            } else {
                ShoppingCart::create([
                    'user_id' => $userId,
                    'maSP' => $product->maSP,
                    'qty' => $request->so_luong,
                    'price' => $product->don_gia,
                ]);
            }
        } else {
            $cart = Cart::content();
            $cartItem = $cart->where('id', $product->maSP)->first();
            if ($cartItem) {
                Cart::update($cartItem->rowId, $cartItem->qty + $request->so_luong);
            } else {
                Cart::add([
                    'id' => $product->maSP,
                    'name' => $product->ten_san_pham,
                    'qty' => $request->so_luong,
                    'price' => $product->don_gia,
                    'options' => [
                        'slug' => $product->slug,
                        'anh' => $product->anh,
                        'ten_danh_muc' => $product->danhMuc->ten_danh_muc,
                        'ten_NSX' => $product->nhaSanXuat->ten_NSX,
                        'added_at' => now(),
                    ]
                ]);
            }
        }

        if ($request->input('action') === 'buy_now') {
            return redirect()->route('home.cart.index');
        }
        return redirect()->back()->with('success', 'Đã Thêm Sản Phẩm Vào Giỏ Hàng');
    }
    public function remove($rowId)
    {
        if(Auth::check()){
            ShoppingCart::where('id',$rowId)->delete();
        }else{
            Cart::remove($rowId);
        }
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }
    public function destroy()
    {
        if(Auth::check()){
            ShoppingCart::where('user_id',Auth::id())->delete();
        }else{
            Cart::destroy();
        }
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
    }
    public function update(Request $request)
    {
        $data = $request->get('qty');
        if(!Auth::check()){
            foreach ($data as $rowId => $qty) {
                $cartItem = Cart::get($rowId);
                if (!$cartItem) {
                    return redirect()->back()->with('error', 'Không tìm thấy mục giỏ hàng.');
                }
                $product = Products::find($cartItem->id);
                if (!$product) {
                    return redirect()->back()->with('error', 'Không tìm thấy sản phẩm trong cơ sở dữ liệu.');
                }
                // dd($product->so_luong_ton);
                if ($product->so_luong_ton < $qty) {
                    return redirect()->back()->with('warning', 'Số lượng tồn kho không đủ cho sản phẩm: ' . $product->ten_san_pham);
                }
                Cart::update($rowId, $qty);
            }
        }else{
            foreach ($data as $id => $qty) {
                $cartItem = ShoppingCart::find($id);
                if (!$cartItem) {
                    return redirect()->back()->with('error', 'Không tìm thấy mục giỏ hàng.');
                }
                $product = Products::find($cartItem->maSP);
                if (!$product) {
                    return redirect()->back()->with('error', 'Không tìm thấy sản phẩm trong cơ sở dữ liệu.');
                }
                if ($product->so_luong_ton < $qty) {
                    return redirect()->back()->with('warning', 'Số lượng tồn kho không đủ cho sản phẩm: ' . $product->ten_san_pham);
                }
                $cartItem->qty = $qty;
                $cartItem->save();
            }
        }
        return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }
}
