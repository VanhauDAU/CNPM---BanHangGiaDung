<?php

namespace App\Models\Admin;
use App\Models\admin\Users;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Post extends Model
{
    use HasFactory;
    protected $table = 'baiviet';
    public function postBy()
    {
        return DB::table('baiviet')
            ->select('baiviet.*', 'taikhoan.*')
            ->join('taikhoan', 'taikhoan.id', '=', 'baiviet.user_id')
            ->orderBy('baiviet.created_at')
            ->get();
    }
    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' INNER JOIN taikhoan ON '.$this->table.'.user_id = taikhoan.id WHERE id_bai_viet = ? ',[$id]);
    }
    public function getAllPosts($filters = [],$keyword = null,$sortArr=null, $perPage = null){
        $posts = DB::table($this->table)
        ->select('baiviet.*','taikhoan.*')
        ->join('taikhoan','taikhoan.id','=','baiviet.user_id');
        $orderBy = 'baiviet.created_at';
        $orderType='desc';
        if(!empty($sortArr) & is_array($sortArr)){
            if(!empty($sortArr['sortBy']) & !empty($sortArr['sortType'])){
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }
        $posts = $posts->orderBy($orderBy,$orderType);
        if(!empty($filters)){
            $posts = $posts->where($filters);
        }
        if(!empty($keyword)){
            $posts = $posts->where(function($query) use ($keyword){
                $query->orWhere('baiviet.tieu_de', 'like', '%' . $keyword . '%');
                $query->orWhere('baiviet.noi_dung', 'like', '%' . $keyword . '%');
                $query->orWhere('baiviet.user_id', 'like', '%' . $keyword . '%');
            });
        }
        if(!empty($perPage)){
            $posts = $posts->paginate($perPage)->appends(request()->query());
        }else{
            $posts = $posts->get();
        }
        return $posts;
    }
}
