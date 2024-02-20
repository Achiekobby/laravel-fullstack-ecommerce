<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','promotion_duration'];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
