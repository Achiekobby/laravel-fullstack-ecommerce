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
        "brand_id",
        "name",
        "admin_id",
        "quantity",
        "regular_price",
        "sales_price",
        "rating",
        "details",
        "photos",
        "discount_percentage",
        "description",
        "status",
        "slug"
    ];

    protected $casts = ["photos"=>"array",'details'=>'array'];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function promotion(){
        return $this->hasOne(Promotion::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }
}
