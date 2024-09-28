<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Products;
class ProductController extends Controller
{
    //
    private $products;
    const _PER_PAGE = 4;
    public function __construct(){
        $this->products = new Products();
    }
    public $data=[];
    public function index(Request $request){
        $title = 'SẢN PHẨM';
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
        return view('clients.products.index', compact('title', 'productList','sortType'));
    }
}
