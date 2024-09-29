<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class contacts extends Model
{
    use HasFactory;
    protected $table = 'lienhe';
    public function addContact($data){
        // $data['password'] = Hash::make($data['password']);
        $timestamp = now();
        $data[] = $timestamp;
        $data[] = $timestamp; 
        DB::insert('INSERT INTO lienhe(ho_ten,email, so_dien_thoai,noi_dung, created_at, updated_at) values (?,?,?,?,?,?)', 
        $data);
    }
}
