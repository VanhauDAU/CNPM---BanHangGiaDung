<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Products;
use App\Http\Requests\Admin\productRequest;
use App\Http\Requests\admin\NSXRequest;
class ProductController extends Controller
{
    //
    private $products;
    const _PER_PAGE = 5;
    public function __construct(){
        $this->products = new products();
    }
    public $data=[];
    public function index(){
        return view('admin.dashboard.index');
    }

    //======================QUẢN LÝ SẢN PHẨM=======================
    public function get_info_detail($id = 0){
        if(!empty($id)){
            $productDetail = $this->products->getDetail($id);
            if(!empty($productDetail[0])){
                $productDetail = $productDetail[0];
            }else{
                return redirect()->route('admin.manage_product')->with('msg','Sản phẩm không tồn tại');
            }
        }else{
            return redirect()->route('manage_product')->with('msg','Mã Sản phẩm không tồn tại');
        }
        return view('admin.products.info_product', compact('productDetail'));
    }
    public function manage_product(Request $request){
        $title = 'DANH SÁCH SẢN PHẨM';
        $products = new Products();
        $filters =[];
        $keyword = null;
        if(!empty($request->nsx)){
            $ma_NSX = $request->nsx;
            $filters[] = ['sanpham.maNSX', '=',$ma_NSX];
        }
        if(!empty($request->nhomSP)){
            $nhom_SP = $request->nhomSP;
            $filters[] = ['taikhoan.nhomSP', '=',$nhom_SP];
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
        $ProductList = $products->getAllProducts($filters, $keyword,$sortArr, self::_PER_PAGE);
        return view('admin.products.index', compact('title', 'ProductList','sortType'));
    }
    public function get_add_product(){
        $this->data['title'] = 'THÊM SẢN PHẨM';
        $this->data['massage'] = 'Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add', $this->data);
    }
    public function post_add_product(productRequest $request){
        $fileName = null;
        if ($request->has('hinh_anh')) {
            $file = $request->hinh_anh;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time().'-'.$ext;
            $file->move(public_path('storage/products/img'), $fileName);
            // $anh = 'storage/products/img'.$file;
        }
        $dataInsert=[
            $request->maSP,
            $request->maNSX,
            $request->nhomSP,
            $request->ten_san_pham,
            $request->don_gia,
            $request->trong_luong,
            $request->mo_ta,
            $request->so_luong_ton,
            $fileName
        ];  
        $this->products->addProduct($dataInsert);
        return redirect()->route('admin.manage_product')->with('msg', 'Thêm mới sản phẩm thành công');
    }
    public function get_add_NSX(){
        $this->data['title'] = 'THÊM NHÀ SẢN XUẤT';
        $this->data['massage'] = 'Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_nsx', $this->data);
    }
    public function post_add_NSX(NSXRequest $request){
        $dataInsert=[
            $request->maNSX,
            $request->ten_NSX,
            $request->dia_chi,
            $request->email,
            $request->so_dien_thoai
        ]; 
        $this->products->addNSX($dataInsert);
        return redirect()->route('getadd_product')->with('msg', 'Thêm mới nhà sản xuất thành công');
    }
    
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
            }
        });
    }
    public function get_edit_product(){

    }
    public function post_edit_product(Request $request, $id){

    }
    public function get_delete_product($id){
        if(!empty($id)){
            $productDetail = $this->products->getDetail($id);
            // dd($userDetail[0]);
            if(!empty($productDetail[0])){
                $deleteproduct = $this->products->deleteUser($id);
                if($deleteproduct){
                    $msg = 'Xóa sản phẩm thành công';
                }else{
                    $msg = 'Bạn không thể xóa sản phẩm lúc này, vui lòng thử lại sau!';
                }
            }else{
                $msg ='Sản phẩm không tồn tại!';
            }
        }else{
            $msg = 'Liên kết không tồn tại';
        }
        return redirect()->route('admin.manage_product')->with('msg',$msg);
    }
    //======================KẾT THÚC QUẢN LÝ SẢN PHẨM=======================
}
