<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id','product_id','name','details','quantity','item_price','sales_price','discount','currency'];

    public function cart(){
        return $this->belongsTo(Cart::class,'cart_id');
    }
}
