<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','meta_keywords','meta_description'];

    public function products(){
        return $this->hasMany(Product::class,'brand_id');
    }
}
