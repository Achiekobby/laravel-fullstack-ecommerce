<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\CategoryResource;
use App\Models\General\Brand;
use App\Models\General\Category;
use App\Models\General\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $products = Product::query()->orderBy('created_at','DESC')->limit(8)->get();

        $promoted_products = Product::with('promotion')->inRandomOrder()->limit(4)->get();

        $brands = Brand::query()->inRandomOrder()->limit(6)->get();

        if($promoted_products->count() < 4){
            //* compute the remainder
            $remaining_items = 4 - $promoted_products->count();
            $regular_products = Product::whereDoesntHave('promotion')->inRandomOrder()->limit($remaining_items)->get();

            //* merge the results
            $promoted_products = $promoted_products->merge($regular_products);
        }

        $categories = Category::query()->get();

        return view("client.client",['products'=>$products, 'categories'=>$categories,'promoted_products'=>$promoted_products,"brands"=>$brands]);
    }

}
