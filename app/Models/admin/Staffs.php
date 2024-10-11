<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staffs extends Model
{
    use HasFactory;
    protected $table ='chucvu';
    protected $primaryKey = 'maCV';

    public function users(){
        return $this->hasMany(Users::class,'maCV','maCV');
    }
    public function postBy(){
        return $this->belongsTo(Users::class,'user_id','id');
    }
}
