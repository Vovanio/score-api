<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_src'
    ];

    public function getImgSrcAttribute($value){
        return env('APP_DOMAIN_STORAGE') . $value;
    }
}
