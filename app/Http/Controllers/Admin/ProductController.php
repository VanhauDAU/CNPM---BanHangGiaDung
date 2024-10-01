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
    const _PER_PAGE = 4;
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
        // dd($productDetail);
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
        if(!empty($request->id_danh_muc)){
            $nhom_SP = $request->id_danh_muc;
            $filters[] = ['sanpham.id_danh_muc', '=',$nhom_SP];
        }
        if(!empty($request->id_chuyen_muc)){
            $nhom_SP = $request->id_chuyen_muc;
            $filters[] = ['sanpham.id_chuyen_muc', '=',$nhom_SP];
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
            $request->maNSX,
            $request->id_danh_muc,
            $request->id_chuyen_muc,
            $request->ten_san_pham,
            $request->don_gia_goc,
            $request->don_gia,
            $request->trong_luong,
            $request->mo_ta,
            $request->so_luong_ton,
            $fileName,
            $request->sp_noi_bat,
            $request->xuat_xu,


        ];  
        // dd($dataInsert);
        $this->products->addProduct($dataInsert);
        toastr()->success('Thành công','Thêm sản phẩm thành công');
        return redirect()->route('admin.manage_product')->with('msg', 'Thêm mới sản phẩm thành công');
    }
    public function get_add_NSX(){
        $this->data['title'] = 'THÊM NHÀ SẢN XUẤT';
        $this->data['massage'] = 'Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_nsx', $this->data);
    }
    public function post_add_NSX(NSXRequest $request){
        $dataInsert=[
            $request->ten_NSX,
            $request->dia_chi,
            $request->email,
            $request->so_dien_thoai
        ]; 
        $this->products->addNSX($dataInsert);
        return redirect()->route('getadd_product')->with('msg', 'Thêm mới nhà sản xuất thành công');
    }
    public function get_add_DM(){
        $this->data['title'] ='THÊM MỚI DANH MỤC SẢN PHẨM';
        $this->data['massage'] ='Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_danhmuc',$this->data);
        
    }
    public function post_add_DM(Request $request){
        request()->validate([
            'ten_danh_muc'=>'required|min:5'
        ],[
            'ten_danh_muc.required'=>'Tên danh mục bắt buộc phải nhập',
            'ten_danh_muc.min'=>'Tên danh mục phải lớn hơn :min ký tự'
        ]);
        $dataInsert=[
            $request->ten_danh_muc,
            $request->icon,
        ];
        $this->products->addDM($dataInsert);
        return redirect()->route('getadd_dm')->with('msg','Thêm mới danh mục thành công');
    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
            }
        });
    }
    public function get_edit_product($id = 0){
        $title = "CẬP NHẬT SẢN PHẨM";
        if(!empty($id)){
            $productDetail = $this->products->getDetail($id);
            // dd($userDetail[0]);
            if(!empty($productDetail[0])){
                $productDetail = $productDetail[0];
            }else{
                return redirect()->route('admin.manage_product')->with('msg','Sản phẩm không tồn tại!');
            }
        }else{
            return redirect()->route('admin.manage_product')->with('msg','Mã Sản phẩm Không Tồn Tại');
        }
        return view('admin.products.edit', compact('title','productDetail'));
    }
    public function post_edit_product(Request $request,$id = 0){
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $productDetail = $this->products->getDetail($id);
        $fileName = null;
        if ($request->has('hinh_anh')) {
            $file = $request->hinh_anh;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time() . '-' . $ext;
            $file->move(public_path('storage/products/img'), $fileName);
            if ($productDetail && !empty($productDetail->anh)) {
                $oldImagePath = public_path('storage/products/img/' . $productDetail['anh']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $fileName = $request->hinh_anh_cu;
        }
        $request->validate([
            'maNSX' => 'required',
            'id_danh_muc' => 'required',
            'ten_san_pham' => 'required|unique:taikhoan,email',
            'don_gia'=>'required|numeric',
        ],[
            'maNSX.required' => 'Mã NSX bắt buộc phải nhập',
            'id_danh_muc.required' => 'Loại sản phẩm bắt buộc phải nhập',
            'ten_san_pham.unique' => 'Tên sản phẩm đã tồn tại trên hệ thống',
            'ten_san_pham.required' => 'Tên sản phẩm bắt buộc phải nhập',
            'don_gia.required'=>'Đơn giá bắt buộc phải nhập',
            'don_gia.numeric'=>'Đơn giá bắt buộc phải là số',
        ]);
        $dataUpdate = [
            $request->maNSX,
            $request->id_danh_muc,
            $fileName,
            $request->ten_san_pham,
            $request->don_gia_goc,
            $request->don_gia,
            $request->trong_luong,
            $request->mo_ta,
            $request->so_luong_ton,
            $request->sp_noi_bat,
            
        ];
        // dd($dataUpdate);
        $this->products->updateProduct($dataUpdate, $id);
        return redirect()->route('getedit_product',['id'=>$id])->with('msg','Cập nhật sản phẩm thành công!');
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
        if($msg ='Xóa sản phẩm thành công'){
            toastr()->success('Thành công','Xóa sản phẩm thành công');
        }else{
            toastr()->warning('Cảnh báo','Xóa sản phẩm thất bại');
        }
        return redirect()->route('admin.manage_product')->with('msg',$msg);
    }
    public function getChuyenMuc($id_danh_muc)
    {
        $chuyenMucs = getChuyenMucSP($id_danh_muc);
        return response()->json($chuyenMucs);
    }
    //======================KẾT THÚC QUẢN LÝ SẢN PHẨM=======================
}
