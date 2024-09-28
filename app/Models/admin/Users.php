<?php

namespace App\Models\admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Users extends Model   
{
    use HasFactory;
    protected $table ='taikhoan';
    protected $primaryKey = 'username';
    protected $fillable = ['username', 'password'];
    public function getAllUsers($filters = [],$keyword = null,$sortArr=null, $perPage = null){
        // $users = DB::select('SELECT * FROM '.$this->table.' ORDER BY username DESC');
        // DB::enableQueryLog();

        $users = DB::table($this->table)
        ->select('taikhoan.*','chucvu.ten_chuc_vu')
        ->join('chucvu','taikhoan.maCV','=','chucvu.maCV');

        $orderBy = 'taikhoan.created_at';
        $orderType='desc';
        if(!empty($sortArr) & is_array($sortArr)){
            if(!empty($sortArr['sortBy']) & !empty($sortArr['sortType'])){
                $orderBy = trim($sortArr['sortBy']);
                $orderType = trim($sortArr['sortType']);
            }
        }
        $users = $users->orderBy($orderBy,$orderType);
        if(!empty($filters)){
            $users = $users->where($filters);
        }
        if(!empty($keyword)){
            $users = $users->where(function($query) use ($keyword){
                $query->orWhere('ho_ten','like','%'.$keyword.'%');
                $query->orWhere('so_dien_thoai','like','%'.$keyword.'%');
                $query->orWhere('email','like','%'.$keyword.'%');
                $query->orWhere('username','like','%'.$keyword.'%');
                $query->orWhere('ngay_sinh','like','%'.$keyword.'%');
                $query->orWhere('gioi_tinh','like','%'.$keyword.'%');
            });
        }
        if(!empty($perPage)){
            $users = $users->paginate($perPage)->appends(request()->query());
        }else{
            $users = $users->get();
        }
        
        // $sql = DB::getQueryLog();
        // dd($sql);
        return $users;
    }

    public function getDetail($id){
        return DB::select('SELECT * FROM '.$this->table.' INNER JOIN chucvu ON '.$this->table.'.maCV = chucvu.maCV WHERE username = ? ORDER BY created_at DESC',[$id]);
    }
    public function addUser($data){
        // $data['password'] = Hash::make($data['password']);
        $timestamp = now();
        $data[] = $timestamp;
        $data[] = $timestamp; 
        DB::insert('INSERT INTO taikhoan(username, password, ho_ten, ngay_sinh, so_dien_thoai, email, dia_chi, loai_tai_khoan, maCV, created_at, updated_at) values (?,?,?,?,?,?,?,?,?,?,?)', 
        $data);
    }
    

    // public function updateUser($data,$id){
    //     $data[] = $id;
    //     return DB::update('UPDATE '.$this->table.' SET username = ?, password =?,ho_ten=?,ngay_sinh=?, so_dien_thoai = ?,email=?, dia_chi = ?, loai_tai_khoan = ?, maCV = ? WHERE username = ?',$data);
    // }
    public function updateUser($data, $id){
        // if (isset($data['password'])) {
        //     $data['password'] = Hash::make($data['password']); // Hash password
        // }
        $data[] = now(); // Thêm giá trị updated_at với thời gian hiện tại
        $data[] = $id; // Thêm id của người dùng cần cập nhật
        
        return DB::update('UPDATE '.$this->table.' SET username = ?, password = ?, ho_ten = ?, ngay_sinh = ?, so_dien_thoai = ?, email = ?,gioi_tinh = ?,cccd= ?, dia_chi = ?, loai_tai_khoan = ?, maCV = ?, updated_at = ? WHERE username = ?', $data);
    }
    
    public function deleteUser($id){
        return DB::delete("DELETE FROM $this->table WHERE username = ? ", [$id]);
    }
}
