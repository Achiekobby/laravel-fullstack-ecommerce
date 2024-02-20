<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['uuid','category_id','name','description','slug','image'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
