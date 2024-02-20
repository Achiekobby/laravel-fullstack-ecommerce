<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $recent_products = Product::query()->orderBy('created_at','DESC')->limit(4)->get();
        return view("admin.dashboard",['recent_products'=>$recent_products]);
    }
}
