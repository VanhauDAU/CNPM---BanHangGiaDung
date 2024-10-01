<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chucvu extends Model
{
    use HasFactory;
    protected $table ='chucvu';
    public function users()
    {
        return $this->hasMany(User::class, 'maCV', 'maCV');
    }
}
