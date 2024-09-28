<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    use HasFactory;
    protected $table = 'chucvu';
    protected $table2 = 'danhmucsanpham';
    protected $table3 = 'nhasanxuat';
    public function getAll(){
        $groups = DB::table($this->table)
        ->orderBy('ten_chuc_vu','ASC')
        ->get();
        return $groups;
    }
    public function getAllDanhMucSp(){
        $groups = DB::table($this->table2)
        ->orderBy('ten_nhom','ASC')
        ->get();
        return $groups;
    }
    public function getAllNSX(){
        $groups = DB::table($this->table3)
        ->orderBy('ten_NSX','ASC')
        ->get();
        return $groups;
    }
}
