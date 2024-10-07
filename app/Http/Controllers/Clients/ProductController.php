<?php

namespace App\Http\Controllers\Clients;
use App\Models\clients\ProductsViewed;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\clients\Products;
use App\Models\admin\comments;
use Illuminate\Support\Facades\DB;
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
        $products->where('trang_thai', '!=', 0); 
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
        $productDetail =DB::table('danhmucsanpham')
        ->select(DB::raw('danhmucsanpham.slug as slugDm, chitietdanhmucsp.slug as slugCm'),'danhmucsanpham.ten_danh_muc','chitietdanhmucsp.ten_chuyen_muc')
        ->join('chitietdanhmucsp','chitietdanhmucsp.id_danh_muc','=','danhmucsanpham.id_danh_muc')
        ->get()->first();
        // dd($productDetail);
        $danhMucNsx = $this->products->getAllNSX();
        $allProduct = $this->products->getAllProductsMAIN();
        // dd($allProduct);
        $productList = $products->paginate(self::_PER_PAGE);
        // dd($productList);
        return view('clients.products.index', compact('title', 'productList','productDetail','danhMucNsx','allProduct'));
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
        $filters[] = ['danhmucsanpham.slug', '=', $id];
        $filters[] = ['sanpham.trang_thai', '=', 1];
        $productList = $this->products->getAllProducts($filters, $keyword, [], self::_PER_PAGE);
        $productDetail =DB::table('danhmucsanpham')
        ->select(DB::raw('danhmucsanpham.slug as slugDm, chitietdanhmucsp.slug as slugCm'),'danhmucsanpham.ten_danh_muc','chitietdanhmucsp.ten_chuyen_muc')
        ->join('chitietdanhmucsp','chitietdanhmucsp.id_danh_muc','=','danhmucsanpham.id_danh_muc')
        ->where('danhmucsanpham.slug',$id)
        ->get()->first();
        $danhMucNsx = $this->products->getDetailDM_Nsx($id);
        return view('clients.products.index', compact('title', 'productList','productDetail','danhMucNsx'));
    }
    public function show2(Request $request, $id, $id2){
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

        $filters[] = ['danhmucsanpham.slug', '=', $id];
        $filters[] = ['chitietdanhmucsp.slug', '=', $id2];
        $filters[] = ['sanpham.trang_thai', '=', 1];
        $productList = $this->products->getAllProducts($filters, $keyword, [], self::_PER_PAGE);
        // $productDetail = $this->products->getDetail3($id2);
        $danhMucNsx = $this->products->getDetailDM_Nsx($id,$id2);
        // dd($danhMucNsx);
        // if(!empty($productDetail)){
        //     $productDetail = $productDetail[0];
        // }
        $productDetail =DB::table('danhmucsanpham')
        ->select(DB::raw('danhmucsanpham.slug as slugDm, chitietdanhmucsp.slug as slugCm'),'danhmucsanpham.ten_danh_muc','chitietdanhmucsp.ten_chuyen_muc')
        ->join('chitietdanhmucsp','chitietdanhmucsp.id_danh_muc','=','danhmucsanpham.id_danh_muc')
        ->where('danhmucsanpham.slug',$id)
        ->where('chitietdanhmucsp.slug',$id2)
        ->get()->first();
        // dd($productDetail);
        
        return view('clients.products.index', compact('title', 'productList','productDetail', 'keyword','danhMucNsx'));
    }
    public function show3(Request $request, $id, $id2,$id3)
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

        $filters[] = ['danhmucsanpham.slug', '=', $id];
        $filters[] = ['chitietdanhmucsp.slug', '=', $id2];
        $filters[] = ['nhasanxuat.slug', '=', $id3];
        $filters[] = ['sanpham.trang_thai', '=', 1];
        $productList = $this->products->getAllProducts($filters, $keyword, [], self::_PER_PAGE);
        $danhMucNsx = $this->products->getDetailDM_Nsx($id,$id2);
        $productDetail =DB::table('danhmucsanpham')
        ->select(DB::raw('danhmucsanpham.slug as slugDm, chitietdanhmucsp.slug as slugCm'),'danhmucsanpham.ten_danh_muc','chitietdanhmucsp.ten_chuyen_muc')
        ->join('chitietdanhmucsp','chitietdanhmucsp.id_danh_muc','=','danhmucsanpham.id_danh_muc')
        ->where('danhmucsanpham.slug',$id)
        ->where('chitietdanhmucsp.slug',$id2)
        ->get()->first();
        $imgBrand =DB::table('nhasanxuat')
        ->where('slug',$id3)
        ->get()->first();
        // dd($imgBrand);
        return view('clients.products.index', compact('title', 'productList','productDetail', 'keyword','danhMucNsx','imgBrand'));
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
        $commentSP = DB::table('binhluansp')
        ->select('taikhoan.ho_ten as ho_ten_KH', 'taikhoan.maCV as maCVMain', 'taikhoan.provider as providerGG', 'taikhoan.anh', 'binhluansp.*','taikhoan.loai_tai_khoan')
        ->leftJoin('taikhoan', 'taikhoan.id', '=', 'binhluansp.user_id')
        ->where('binhluansp.maSP', $productDetail->maSP)
        ->where('binhluansp.trang_thai', 1)
        ->orderBy('binhluansp.created_at', 'DESC')
        ->get();

        // dd($commentSP);
        // Lấy phản hồi cho từng bình luận
        foreach ($commentSP as $comment) {
            $comment->replies = DB::table('binhluansp')
                ->select('taikhoan.ho_ten as ho_ten_KH', 'binhluansp.*','taikhoan.anh as anhReply','taikhoan.anh','taikhoan.loai_tai_khoan','taikhoan.provider as providerReply','taikhoan.maCV as maCVReply')
                ->leftJoin('taikhoan', 'taikhoan.id', '=', 'binhluansp.user_id')
                ->where('binhluansp.parent_id', $comment->id)
                ->orderBy('binhluansp.created_at', 'ASC')
                ->get();
                // Lấy phản hồi cho từng bình luận con
            foreach ($comment->replies as $reply) {
                $reply->replies2 = DB::table('binhluansp')
                    ->select('taikhoan.ho_ten as ho_ten_KH', 'binhluansp.*', 'taikhoan.anh as anhReply2', 'taikhoan.loai_tai_khoan', 'taikhoan.provider as providerReply2', 'taikhoan.maCV as maCVReply2')
                    ->leftJoin('taikhoan', 'taikhoan.id', '=', 'binhluansp.user_id')
                    ->where('binhluansp.parent_id', $reply->id)
                    ->orderBy('binhluansp.created_at', 'ASC')
                    ->get();
                    // dd($reply->replies2);
    }
        }
        // dd($commentSP);
        $title=$productDetail->ten_san_pham;
        return view('clients.products.detail_product', compact('title','productDetail','commentSP'));
    }
    

}
