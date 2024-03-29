<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    use HasFactory;


    protected $fillable = [
        "user_id",
        "first_name",
        "last_name",
        "phone_number",
        "address",
        "state",
        "city",
        "country",
        "country_abbr",
        "geolocation"
    ];

    protected $casts = [
        "geolocation"=>"array"
    ];

    //* Relationships
    public function user(){
        return $this->belongsTo(User::class);
    }
}
