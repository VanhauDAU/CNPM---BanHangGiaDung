<?php

namespace App\Http\Controllers\Clients;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\clients\Products;
use App\Models\admin\Post as adminPost;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    //
    private $products;
    const _PER_PAGE = 4;
    public function __construct(){
        $this->products = new Products();
    }
    public $data=[];
    public function index(Request $request){
        $title = 'Website Bán Hàng Gia Dụng - VĂN HẬU';
        $filters =[];
        $keyword = null;
        $products = $this->products->newQuery();
        $filters[] = ['sanpham.trang_thai', '=', 1];
        $posts = adminPost::orderBy('created_at', 'desc')->where('trang_thai',1)->take(4)->get();
        //end xử lý
        $sortType = '';
        $productList = $this->products->getAllProducts($filters, $keyword,$sortArr=null, self::_PER_PAGE);
        $allProduct = $this->products->getAllProductsMAIN();
        // dd($allProduct);
        // dd($productList);
        // dd($posts);
        $danhMucNsx = $this->products->getAllNSX();
        $brand = DB::table('nhasanxuat')
        ->join('nsx_danhmuc', 'nsx_danhmuc.maNSX', '=', 'nhasanxuat.maNSX')
        ->select('nhasanxuat.*') 
        ->distinct()
        ->get();
        $user = Auth::user();
        // Truyền sản phẩm đã xem sang view
        if(Auth::check()){
            $viewedProducts = DB::table('sanphamdaxem')
            ->where('user_id', $user->id)
            ->pluck('product_id') 
            ->toArray();
            $viewedProductDetails = Products::whereIn('maSP', $viewedProducts)->get();
        }else{
            $viewedProducts = session()->get('viewed_products', []);
            $viewedProductDetails = Products::whereIn('maSP', $viewedProducts)->get();
        }
        // dd($brand);
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $products->where('ten_san_pham', 'like', '%' . $keyword . '%');
            return view('clients.products.index', compact('title', 'productList','danhMucNsx','allProduct','brand','viewedProductDetails'));
        }
        return view('clients.home.home', compact('title', 'productList','sortType','posts','allProduct','brand','viewedProductDetails'));
    }
    public function products(){
        $this->data['title'] = 'SẢN PHẨM';
        return view('Clients.products.products', $this->data);
    }
    public function get_lien_he(){
        return view('clients.contact.index');
    }
}
