<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Products;
class ProductController extends Controller
{
    //
    private $products;
    const _PER_PAGE = 8;
    public function __construct(){
        $this->products = new Products();
    }
    public $data=[];
    public function index(Request $request)
    {
        $title = 'SẢN PHẨM';
        $filters = [];
        $keyword = null;

        // Khởi tạo query builder cho sản phẩm
        $products = $this->products->newQuery(); 

        // Xử lý sắp xếp
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'tangdan':
                    $products->orderBy('don_gia', 'asc');
                    break;
                case 'giamdan':
                    $products->orderBy('don_gia', 'desc');
                    break;
                case 'giamgia':
                    $products->orderBy('discount', 'desc');
                    break;
                case 'moinhat':
                    $products->orderBy('created_at', 'desc');
                    break;
                case 'banchay':
                    $products->orderBy('created_at', 'desc');
                    break;
            }
        }

        if (!empty($request->nsx)) {
            $maNSX = $request->nsx;
            $filters[] = ['sanpham.maNSX', '=', $maNSX];
        }
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $products->where('ten_san_pham', 'like', '%' . $keyword . '%');
        }
        foreach ($filters as $filter) {
            $products->where($filter[0], $filter[1], $filter[2]);
        }
        $productDetail ='';
        // Lấy danh sách sản phẩm đã sắp xếp và lọc
        $productList = $products->paginate(self::_PER_PAGE);
        return view('clients.products.index', compact('title', 'productList','productDetail'));
    }
    public function show(Request $request, $id)
    {
        $filters = [];
        $keyword = null;
        $title = 'SẢN PHẨM';
        if (!empty($request->nsx)) {
            $maNSX = $request->nsx;
            $filters[] = ['sanpham.maNSX', '=', $maNSX];
        }
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
        }
        $filters[] = ['sanpham.id_danh_muc', '=', $id];
        $productList = $this->products->getAllProducts($filters, $keyword, [], self::_PER_PAGE);
        $productDetail = $this->products->getDetail2($id);
        // dd($productDetail);
        if(!empty($productDetail)){
            $productDetail = $productDetail[0];
        }
        return view('clients.products.index', compact('title', 'productList','productDetail'));
    }
    public function show2(Request $request, $id, $id2)
    {
        $filters = [];
        $keyword = null;
        $title = 'SẢN PHẨM';
        if (!empty($request->nsx)) {
            $maNSX = $request->nsx;
            $filters[] = ['sanpham.maNSX', '=', $maNSX];
        }
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
        }

        $filters[] = ['sanpham.id_danh_muc', '=', $id];
        $filters[] = ['sanpham.id_chuyen_muc', '=', $id2];
        $productList = $this->products->getAllProducts($filters, $keyword, [], self::_PER_PAGE);
        $productDetail = $this->products->getDetail3($id2);
        if(!empty($productDetail)){
            $productDetail = $productDetail[0];
        }
        return view('clients.products.index', compact('title', 'productList','productDetail', 'keyword'));
    }

    public function detail_product($id){
        if(!empty($id)){
            $productDetail = $this->products->getDetail($id);
            if(!empty($productDetail[0])){
                $productDetail = $productDetail[0];
            }else{
                return redirect()->route('home.products.index')->with('msg','Sản phẩm không tồn tại');
            }
        }else{
            return redirect()->route('home.products.index')->with('msg','Mã Sản phẩm không tồn tại');
        }
        $title=$productDetail->ten_san_pham;
        return view('clients.products.detail_product', compact('title','productDetail'));
    }

}
