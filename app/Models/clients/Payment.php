<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'donhang';
    public function ward(){
        return $this->beLongsTo(Ward::class,'wards_id');
    }

    public function district(){
        return $this->beLongsTo(District::class,'district_id');
    }

    public function province(){
        return $this->beLongsTo(Province::class,'province_id');
    }
}