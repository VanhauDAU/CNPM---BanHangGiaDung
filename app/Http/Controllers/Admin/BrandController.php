<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Brands;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BrandController extends Controller
{
    //
    private $brand;
    public function __construct()
    {
        
    }
    public function getBrand($id){
        $title = 'CÁC SẢN PHẨM';
        $brand = DB::table('nhasanxuat')
        ->join('nsx_danhmuc','nsx_danhmuc.maNSX','=','nhasanxuat.maNSX')
        ->where('slug',$id)
        ->first();
        // dd($brand);
        $danhmucbrand = DB::table('nhasanxuat')
        ->join('nsx_danhmuc','nsx_danhmuc.maNSX','=','nhasanxuat.maNSX')
        ->join('chitietdanhmucsp','chitietdanhmucsp.id_chuyen_muc','=','nsx_danhmuc.id_chuyen_muc')
        ->join('sanpham','sanpham.id_chuyen_muc','=','nsx_danhmuc.id_chuyen_muc')
        ->join('danhmucsanpham','danhmucsanpham.id_danh_muc','=','nsx_danhmuc.id_danh_muc')
        ->where('nhasanxuat.slug',$id)
        ->select('chitietdanhmucsp.*','danhmucsanpham.slug as slugDm','nhasanxuat.slug as slugNSX')
        ->distinct()
        ->get();

        // dd($danhmucbrand);
        return view('clients.brand.index', compact('title','brand', 'danhmucbrand'));
    }

}
