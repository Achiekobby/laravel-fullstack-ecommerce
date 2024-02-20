<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","total_amount",'total_items','status'];

    public function cartItems(){
        return $this->hasMany(CartItem::class,'cart_id');
    }
}
