<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price',
        'img_src'
    ];

    /**
     * @param string $value
     * @return string
     */
    public function getImgSrcAttribute($value){
        return env('APP_DOMAIN_STORAGE') . $value;
    }
}
