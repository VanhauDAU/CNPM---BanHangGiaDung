<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\PromotionRequest;
use App\Models\Admin\Promotion;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    //
    public function index(){
        $title ='QUẢN LÝ KHUYẾN MÃI';
        $AllPromotions = Promotion::all();
        return view('admin.promotion.index', compact('title','AllPromotions'));
    }
    public function add(){
        return view('admin.promotion.add');
    }
    public function postAdd(PromotionRequest $request){
        $promotion = new Promotion();
        $promotion->ma_khuyen_mai = $request->ma_khuyen_mai;
        $promotion->loai_khuyen_mai = $request->loai_khuyen_mai;
        $promotion->so_luong_su_dung = $request->so_luong_su_dung;
        $promotion->ngay_bat_dau = $request->ngay_bat_dau;
        $promotion->ngay_ket_thuc = $request->ngay_ket_thuc;
        $promotion->ten_khuyen_mai = $request->ten_khuyen_mai;
        $promotion->gia_tri_khuyen_mai = $request->gia_tri_khuyen_mai;
        $promotion->trang_thai = $request->trang_thai;
        $promotion->slug = $request->slug;
        $promotion->mo_ta = $request->mo_ta;
        try {
            $promotion->save();
            $msg = 'Thêm khuyến mãi thành công';
        } catch (\Exception $e) {
            $msg = 'Thêm khuyến mãi không thành công: ' . $e->getMessage(); // Thông báo lỗi nếu có
        }
        
        // dd($promotion);
        return redirect()->route('admin.promotions.index')->with('msg',$msg);
    }
    public function edit($id = 0){
        $promotion = Promotion::find($id);
        return view('admin.promotion.edit',compact('promotion'));
    }
    public function postEdit(PromotionRequest $request,$id = 0){
        $promotion = Promotion::find($id);
        $existingPromotion = DB::table('khuyenmai')
            ->where('slug', $request->slug)
            ->where('id', '!=', $id)
            ->first();
        if ($existingPromotion) {
            toastr()->warning('Thất bại','Đường dẫn đã tồn tại!');
            return back();
        }
        $promotion->loai_khuyen_mai = $request->loai_khuyen_mai;
        $promotion->so_luong_su_dung = $request->so_luong_su_dung;
        $promotion->ngay_bat_dau = $request->ngay_bat_dau;
        $promotion->ngay_ket_thuc = $request->ngay_ket_thuc;
        $promotion->ten_khuyen_mai = $request->ten_khuyen_mai;
        $promotion->gia_tri_khuyen_mai = $request->gia_tri_khuyen_mai;
        $promotion->trang_thai = $request->trang_thai;
        $promotion->slug = $request->slug;
        $promotion->mo_ta = $request->mo_ta;
        $promotion->save();
        $msg = 'Sửa khuyến mãi '.$promotion->ma_khuyen_mai.' thành công';
        return redirect()->back()->with('success',$msg);
    }
    public function delete($id){
        $deleteStatus =  Promotion::destroy($id);
        if($deleteStatus){
            $msg = 'Xóa khuyến mãi thành công';
        }else{
            $msg = 'Xóa khuyến mãi không thành công';
        }
        return redirect()->back()->with('msg',$msg);
    }
}
