<?php

namespace App\Http\Controllers\Clients;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\clients\Products;
use App\Models\admin\Post as adminPost;
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
        
        $posts = adminPost::orderBy('created_at', 'desc')->where('trang_thai',1)->take(6)->get();
        //end xử lý
        $sortType = '';
        $productList = $this->products->getAllProducts($filters, $keyword,$sortArr=null, self::_PER_PAGE);
        $allProduct = $this->products->getAllProductsMAIN();
        // dd($allProduct);
        // dd($productList);
        // dd($posts);
        $danhMucNsx = $this->products->getAllNSX();
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
            $products->where('ten_san_pham', 'like', '%' . $keyword . '%');
            return view('clients.products.index', compact('title', 'productList','danhMucNsx','allProduct'));
        }
        return view('clients.home.home', compact('title', 'productList','sortType','posts','allProduct'));
    }
    public function products(){
        $this->data['title'] = 'SẢN PHẨM';
        return view('Clients.products.products', $this->data);
    }
    public function get_lien_he(){
        return view('clients.contact.index');
    }
}
