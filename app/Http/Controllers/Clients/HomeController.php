<?php

namespace App\Http\Controllers\Clients;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\clients\Products;
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
        if(!empty($request->nsx)){
            $maNSX = $request->nsx;
            $filters[] = ['sanpham.maNSX', '=',$maNSX];
        }
        if(!empty($request->keyword)){
            $keyword = $request->keyword;
        }
        //Xử lý logic sắp xếp theo cột
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $arrSort =['ASC', 'DESC'];
        if(!empty($sortType) & in_array($sortType,$arrSort)){
            if($sortType=='DESC'){
                $sortType ='ASC';
            }else{
                $sortType ='DESC';
            }
        }else{
            $sortType ='ASC';
        }
        $sortArr =[
            'sortBy'=>$sortBy,
            'sortType'=>$sortType
        ];
        //end xử lý
        $productList = $this->products->getAllProducts($filters, $keyword,$sortArr, self::_PER_PAGE);
        // dd($productList);
        return view('clients.home.home', compact('title', 'productList','sortType'));
    }
    public function products(){
        $this->data['title'] = 'SẢN PHẨM';
        return view('Clients.products.products', $this->data);
    }
    public function get_lien_he(){
        return view('clients.contact.index');
    }
}
