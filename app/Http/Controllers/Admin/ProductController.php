<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Products;
use App\Models\clients\ProductImages;
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
    // public function index(){
    //     return view('admin.dashboard.index');
    // }

    //======================QUẢN LÝ SẢN PHẨM=======================
    public function detailProduct($id = 0){
        if(!empty($id)){
            $productDetail = $this->products->getDetail($id);
            if(!empty($productDetail[0])){
                $productDetail = $productDetail[0];
            }else{
                return redirect()->route('admin.products.index')->with('msg','Sản phẩm không tồn tại');
            }
        }else{
            return redirect()->route('admin.products.index')->with('msg','Mã Sản phẩm không tồn tại');
        }
        // dd($productDetail);
        return view('admin.products.info_product', compact('productDetail'));
    }
    public function index(Request $request){
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
    public function addProduct(){
        $this->data['title'] = 'THÊM SẢN PHẨM';
        $this->data['massage'] = 'Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add', $this->data);
    }
    public function postAddProduct(productRequest $request) {
        $imageNames = [];
    
        if ($request->has('hinh_anh')) {
            $files = $request->file('hinh_anh'); // Lấy mảng file hình ảnh
    
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();  
                $fileName = time() . '-' . uniqid() . '.' . $ext;
                $file->move(public_path('storage/products/img'), $fileName);
                $imageNames[] = $fileName; // Lưu đường dẫn hình ảnh
            }
        }
        $product = new Products();
        $product->maNSX = $request->maNSX;
        $product->id_danh_muc = $request->id_danh_muc;
        $product->id_chuyen_muc = $request->id_chuyen_muc;
        $product->ten_san_pham = $request->ten_san_pham;
        $product->don_gia_goc = $request->don_gia_goc;
        $product->don_gia = $request->don_gia;
        $product->trong_luong = $request->trong_luong;
        $product->mo_ta = $request->mo_ta;
        $product->so_luong_nhap = $request->so_luong_nhap;
        $product->so_luong_ton = $request->so_luong_ton;
        $product->anh = isset($fileName) ? $fileName : null; // Lưu tên file hình ảnh đầu tiên nếu có
        $product->sp_noi_bat = $request->sp_noi_bat;
        $product->xuat_xu = $request->xuat_xu;
        $product->slug = $request->slug;
        
        $product->save();
        if (!empty($imageNames)) {
            foreach ($imageNames as $imagePath) {
                $productImage = new ProductImages();
                $productImage->product_id = $product->maSP;
                $productImage->anh = $imagePath; // Gán đường dẫn hình ảnh
                $productImage->save();
            }
        }
    
        toastr()->success('Thành công', 'Thêm sản phẩm thành công');
        return redirect()->route('admin.products.index')->with('msg', 'Thêm mới sản phẩm thành công');
    }
    
    public function addNsx(){
        $this->data['title'] = 'THÊM NHÀ SẢN XUẤT';
        $this->data['massage'] = 'Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_nsx', $this->data);
    }
    public function postAddNsx(NSXRequest $request){
        $fileName = null;
        if ($request->has('logo')) {
            $file = $request->logo;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time().'-'.$ext;
            $file->move(public_path('storage/brands/img'), $fileName);
            // $anh = 'storage/products/img'.$file;
        }
        $dataInsert=[
            $request->ten_NSX,
            $request->dia_chi,
            $request->email,
            $request->so_dien_thoai,
            $fileName,
            $request->slugNSX,
        ]; 
        $this->products->addNSX($dataInsert);
        return redirect()->route('admin.products.addProduct')->with('msg', 'Thêm mới nhà sản xuất thành công');
    }
    public function addDm(){
        $this->data['title'] ='THÊM MỚI DANH MỤC SẢN PHẨM';
        $this->data['massage'] ='Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_danhmuc',$this->data);
        
    }
    public function addCm(){
        $this->data['title'] ='THÊM MỚI CHUYÊN MỤC SẢN PHẨM';
        $this->data['massage'] ='Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_chuyenmuc',$this->data);
        
    }
    public function addCmNsx(){
        $this->data['title'] ='THÊM MỚI DANH MỤC SẢN PHẨM';
        $this->data['massage'] ='Đã có lỗi xảy ra, vui lòng kiểm tra lại dữ liệu!';
        return view('admin.products.add_cm_nsx',$this->data);
    }
    public function postAddCmNsx(Request $request){
        request()->validate([
            'maNSX'=>'required',
            'id_chuyen_muc'=>'required',
            'id_danh_muc'=>'required'
        ],[
            'maNSX.required'=>'Nhà sản xuất chưa được chọn',
            'ten_danh_muc.required'=>'Tên danh mục chưa được chọn',
            'id_chuyen_muc.required'=>'Tên danh mục chưa được chọn'
        ]);
        $exists = $this->products->checkDuplicate($request->maNSX, $request->id_danh_muc, $request->id_chuyen_muc);

        if ($exists) {
            // toastr()->warning('Thất bị','Thêm chuyên mục cho NSX thất bại');
            return back()->withErrors(['duplicate' => 'Đã tồn tại bản ghi với Nhà sản xuất, Danh mục và Chuyên mục này.'])->withInput();
        }
        $dataInsert=[
            $request->maNSX,
            $request->id_danh_muc,
            $request->id_chuyen_muc,
        ];
        $this->products->addCM_NSX($dataInsert);
        
        return redirect()->route('admin.products.addCmNsx')->with('success','Thêm chuyên mục cho NSX thành công');
    }
    public function postAddDm(Request $request){
        request()->validate([
            'ten_danh_muc'=>'required|min:2|unique:danhmucsanpham,ten_danh_muc',
            'icon'=>'required',
            'slug'=>'unique:danhmucsanpham,slug',
        ],[
            'ten_danh_muc.required'=>'Tên danh mục bắt buộc phải nhập',
            'ten_danh_muc.min'=>'Tên danh mục phải lớn hơn :min ký tự',
            'ten_danh_muc.unique'=>'Tên danh mục đã tồn tại',
            'icon.required'=>'Icon bắt buộc phải có',
            'slug.unique'=>'Đường dẫn đã tồn tại',
        ]);
        $dataInsert=[
            $request->ten_danh_muc,
            $request->icon,
            $request->slug,
        ];
        $this->products->addDM($dataInsert);
        return redirect()->route('admin.products.addDm')->with('msg','Thêm mới danh mục thành công');
    }
    public function postAddCm(Request $request){
        $fileName = null;
        if ($request->has('anh')) {
            $file = $request->anh;  
            $ext = $file->getClientOriginalExtension();  
            $fileName = time().'-'.$ext;
            $file->move(public_path('storage/products/img'), $fileName);
            // $anh = 'storage/products/img'.$file;
        }
        request()->validate([
            'ten_danh_muc'=>'required',
            'ten_chuyen_muc'=>'required',
            'slug'=>'unique:danhmucsanpham,slug',
        ],[
            'ten_danh_muc.required'=>'Danh mục bắt buộc phải nhập',
            'ten_chuyen_muc.required'=>'Tên chuyên mục bắt buộc phải có',
            'slug.unique'=>'Đường dẫn đã tồn tại',
        ]);
        $dataInsert=[
            $request->ten_danh_muc,
            $request->ten_chuyen_muc,
            $request->slug,
            $fileName
        ];
        $this->products->addCM($dataInsert);
        return redirect()->route('admin.products.addCm')->with('success','Thêm mới danh mục thành công');
    }
    public function withValidator($validator){
        $validator->after(function ($validator) {
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg', 'Đã có lỗi xảy ra, vui lòng kiểm tra lại!');
            }
        });
    }
    public function edit($id = 0){
        $title = "CẬP NHẬT SẢN PHẨM";
        if(!empty($id)){
            $productDetail = Products::find($id);
            if(empty($productDetail)){
                return redirect()->route('admin.products.index')->with('msg','Sản phẩm không tồn tại!');
            }
        }else{
            return redirect()->route('admin.products.index')->with('msg','Mã Sản phẩm Không Tồn Tại');
        }
        return view('admin.products.edit', compact('title','productDetail'));
    }
    public function postEdit(Request $request,$id = 0){
        if(empty($id)){
            return back()->with('msg','Liên kết không tồn tại');
        }
        $productDetail = Products::find($id);
        $imageNames = [];
        if ($request->has('hinh_anh')) {
            $files = $request->file('hinh_anh'); 
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();  
                $fileName = time() . '-' . uniqid() . '.' . $ext;
                $file->move(public_path('storage/products/img'), $fileName);
                $imageNames[] = $fileName;
            }
            $oldImages = ProductImages::where('product_id', $id)->get();
            foreach ($oldImages as $oldImage) {
                $oldImagePath = public_path('storage/products/img/' . $oldImage->anh);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $oldImage->delete(); // Xóa bản ghi trong cơ sở dữ liệu
            }
            foreach ($imageNames as $imageName) {
                $productImage = new ProductImages();
                $productImage->product_id = $id;
                $productImage->anh = $imageName;
                $productImage->save();
            }
            if (!empty($productDetail->anh)) {
                $oldImagePath = public_path('storage/products/img/' . $productDetail->anh);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $productDetail->anh = !empty($imageNames) ? $imageNames[0] : $productDetail->anh;
        } else {
            $productDetail->anh = $request->hinh_anh_cu;
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
            $request->so_luong_nhap,
            $request->sp_noi_bat,
            $request->trang_thai,
            
        ];
        // dd($dataUpdate);
        $this->products->updateProduct($dataUpdate, $id);
        return redirect()->route('admin.products.edit',['id'=>$id])->with('msg','Cập nhật sản phẩm thành công!');
    }
    public function deleteNsx($id) {
        if (!empty($id)) {
            $nsxDetail = $this->products->getDetailNsx($id);
    
            if (!empty($nsxDetail[0])) {
                try {
                    $deleteNsx = $this->products->deleteNsx($id);
                    if ($deleteNsx) {
                        toastr()->success('Thành công', 'Xóa NSX thành công');
                    } else {
                        toastr()->warning('Thất bại', 'Bạn không thể xóa NSX lúc này, vui lòng thử lại sau!');
                    }
                } catch (\Exception $e) {
                    // Chỉ thông báo cho người dùng mà không hiển thị lỗi ra ngoài
                    toastr()->warning('Thất bại', 'Bạn không thể xóa NSX vì có liên kết với các mục khác.');
                }
            } else {
                toastr()->warning('Thất bại', 'NSX không tồn tại!');
            }
        } else {
            toastr()->warning('Cảnh báo', 'Liên kết không tồn tại');
        }
    
        return redirect()->route('admin.products.addNsx');
    }
    public function deleteDm($id) {
        if (!empty($id)) {
            $dmDetail = $this->products->getDetailDm($id);
    
            if (!empty($dmDetail[0])) {
                try {
                    $deleteDm = $this->products->deleteDm($id);
                    if ($deleteDm) {
                        toastr()->success('Thành công', 'Xóa danh mục thành công');
                    } else {
                        toastr()->warning('Thất bại', 'Bạn không thể xóa Danh mục lúc này, vui lòng thử lại sau!');
                    }
                } catch (\Exception $e) {
                    toastr()->warning('Thất bại', 'Bạn không thể xóa danh mục vì có liên kết với các mục khác.');
                }
            } else {
                toastr()->warning('Thất bại', 'Danh mục không tồn tại!');
            }
        } else {
            toastr()->warning('Cảnh báo', 'Liên kết không tồn tại');
        }
    
        return redirect()->route('admin.products.addDm');
    }
    public function delete($id) {
        if (!empty($id)) {
            $productDetail = $this->products->getDetail($id);
            if (!empty($productDetail[0])) {
                $this->products->deleteProductImages($id);
                $deleteProduct = $this->products->deleteUser($id);
                
                if ($deleteProduct) {
                    $msg = 'Xóa sản phẩm thành công';
                } else {
                    $msg = 'Bạn không thể xóa sản phẩm lúc này, vui lòng thử lại sau!';
                }
            } else {
                $msg = 'Sản phẩm không tồn tại!';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }
        if ($msg == 'Xóa sản phẩm thành công') {
            toastr()->success('Thành công', 'Xóa sản phẩm thành công');
        } else {
            toastr()->warning('Cảnh báo', $msg);
        }
    
        return redirect()->route('admin.products.index')->with('msg', $msg);
    }
    public function getChuyenMuc($maNSX, $id_danh_muc)
    {
        $chuyenMucs = getChuyenMucSP($maNSX, $id_danh_muc);
        return response()->json($chuyenMucs);
    }
    public function getDanhMuc($ma_NSX)
    {
        $danhMucs = getDanhMucSP($ma_NSX);
        return response()->json($danhMucs);
    }
    //======================KẾT THÚC QUẢN LÝ SẢN PHẨM=======================
}
