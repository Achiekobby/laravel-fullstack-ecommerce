<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "uuid",
        "category_id",
        "subcategory_id",
        "name",
        "admin_id",
        "quantity",
        "regular_price",
        "sales_price",
        "rating",
        "brand",
        "details",
        "photos",
        "discount_percentage",
        "description",
        "status",
        "slug"
    ];

    protected $casts = ["photos"=>"array"];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function promotion(){
        return $this->hasOne(Promotion::class);
    }
}
