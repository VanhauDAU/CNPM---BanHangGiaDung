<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Models\admin\products;
use App\Models\admin\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = products::find($id);
        if (!$product) {
            toastr()->warning('Cảnh báo', 'Sản phẩm không tồn tại.');
            return back();
        }

        $quantityToAdd = $request->input('so_luong', 1);

        // Kiểm tra số lượng thêm vào có lớn hơn so_luong_ton không
        if ($quantityToAdd > $product->so_luong_ton) {
            toastr()->warning('Cảnh báo', 'Số lượng yêu cầu vượt quá số lượng tồn.');
            return back();
        }

        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $oldQuantity = $cart[$id]['so_luong'];
            $newQuantity = $oldQuantity + $quantityToAdd;

            // Nếu số lượng mới lớn hơn so_luong_ton thì thông báo lỗi
            if ($newQuantity > $product->so_luong_ton) {
                toastr()->warning('Cảnh báo', 'Số lượng yêu cầu vượt quá số lượng tồn.');
                return back();
            }
            $cart[$id]['so_luong'] = $newQuantity;
            
            // Cập nhật số lượng trong cơ sở dữ liệu
            if (Auth::check()) {
                ShoppingCart::where('user_id', Auth::id())
                    ->where('maSP', $id)
                    ->update(['so_luong' => $newQuantity]);
            }
        } else {
            $cart[$id] = [
                "ten_san_pham" => $product->ten_san_pham,
                "so_luong" => $quantityToAdd,
                "don_gia" => $product->don_gia,
                "anh" => $product->anh,
                "slug" => $product->slug,
                "so_luong_ton" => $product->so_luong_ton
            ];

            // Thêm sản phẩm vào cơ sở dữ liệu nếu người dùng đã đăng nhập
            if (Auth::check()) {
                ShoppingCart::create([
                    'user_id' => Auth::id(),
                    'maSP' => $id,
                    'so_luong' => $quantityToAdd
                ]);
            }
        }

        session()->put('cart', $cart);
        toastr()->success('Thành công', 'Sản phẩm đã được thêm vào giỏ hàng!');
        return redirect()->back();
    }


    public function viewCart()
    {
        $title = 'GIỎ HÀNG';
        $cart = session()->get('cart', []);
        
        // Nếu người dùng đã đăng nhập, lấy giỏ hàng từ cơ sở dữ liệu
        if (Auth::check()) {
            $dbCartItems = ShoppingCart::where('user_id', Auth::id())->get();
            foreach ($dbCartItems as $item) {
                $product = products::find($item->maSP);
                if ($product) {
                    $cart[$item->maSP] = [
                        "ten_san_pham" => $product->ten_san_pham,
                        "so_luong" => $item->so_luong,
                        "don_gia" => $product->don_gia,
                        "anh" => $product->anh,
                        "slug" => $product->slug,
                        "so_luong_ton" => $product->so_luong_ton
                    ];
                }
            }
            session()->put('cart', $cart);
        }

        return view('clients.shoppingCart.index', compact('cart', 'title'));
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $product = products::find($id);

        if (!$product) {
            toastr()->warning('Cảnh báo', 'Sản phẩm không tồn tại.');
            return redirect()->back();
        }

        if (isset($cart[$id])) {
            $quantity = $request->input('so_luong', 1);

            // Kiểm tra số lượng nhập vào không vượt quá so_luong_ton
            if ($quantity <= 0) {
                toastr()->warning('Cảnh báo', 'Số lượng phải lớn hơn 0.');
                return redirect()->back();
            }

            if ($quantity > $product->so_luong_ton) {
                toastr()->warning('Cảnh báo', 'Số lượng yêu cầu vượt quá số lượng tồn.');
                return redirect()->back();
            }

            // Cập nhật số lượng trong giỏ hàng
            $cart[$id]['so_luong'] = $quantity;
            session()->put('cart', $cart);
            
            // Cập nhật lại số lượng trong cơ sở dữ liệu nếu người dùng đã đăng nhập
            if (Auth::check()) {
                ShoppingCart::where('user_id', Auth::id())
                    ->where('maSP', $id)
                    ->update(['so_luong' => $quantity]);
            }

            toastr()->success('Thành công', 'Số lượng đã được cập nhật!');
        } else {
            toastr()->warning('Cảnh báo', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        return redirect()->back();
    }


    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []); 

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart); 
            
            if (Auth::check()) {
                ShoppingCart::where('user_id', Auth::id())
                    ->where('maSP', $id)
                    ->delete();
            }

            toastr()->success('Thành công', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
        } else {
            toastr()->warning('Cảnh báo', 'Sản phẩm không tồn tại trong giỏ hàng.');
        }

        return redirect()->route('home.cart.view'); // Đảm bảo route này hoạt động
    }


    public function checkout()
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $id => $item) {
            $product = products::find($id);
            if ($product) {
                // Giảm số lượng tồn trong cơ sở dữ liệu
                $product->decrement('so_luong_ton', $item['so_luong']);
            }
        }

        // Xóa giỏ hàng sau khi thanh toán
        session()->forget('cart');
        toastr()->success('Thành công', 'Thanh toán thành công!');
        return redirect()->route('home.index'); // Chuyển hướng về trang chính
    }
}
