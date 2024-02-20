<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["category_name","category_code",'description','image','slug','created_by'];

    public function subcategories(){
        return $this->hasMany(Subcategory::class,'category_id');
    }
}
