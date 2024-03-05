<?php

namespace App\Providers;

use App\Http\Resources\Client\CategoryResource;
use App\Models\General\Brand;
use App\Models\General\Category;
use App\Models\General\Product;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ShopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('client.shop', function (View $view) {

            // dd($this->fetch_price_range_count([100,200]));
            $categories_with_products = Category::with('products')->get();
            $all_count = 0;
            foreach ($categories_with_products as $category) {
                $all_count += $category->products->count();
            }

            //* for brand
            $brand_with_products = Brand::with('products')->get();
            $all_brands = 0;
            foreach($brand_with_products as $brand){
                $all_brands += $brand->products->count();
            }
            $view->with([
                "price_all_count"   => $this->fetch_price_range_count(null),
                "price_one_count"   => $this->fetch_price_range_count([0, 100]),
                "price_two_count"   => $this->fetch_price_range_count([100, 200]),
                "price_three_count" => $this->fetch_price_range_count([200, 300]),
                "price_four_count"  => $this->fetch_price_range_count([300, 400]),
                "price_five_count"  => $this->fetch_price_range_count([400, null]),
                "categories"        => CategoryResource::collection($categories_with_products),
                'all_count'         => $all_count,
                "brands"            =>$brand_with_products,
                "all_brands"        =>$all_brands,
            ]);
        });
    }

    private function fetch_price_range_count($range)
    {
        $count = 0;
        if ($range === null) {
            $count = Product::query()->count();
        } elseif (is_array($range)) {
            $min = (float)$this->parsePrice($range[0]);
            $max = $range[1] === null ? null : (float)$this->parsePrice($range[1]);

            if ($max === null) {
                $count =  Product::query()->where('regular_price', '>=', $min)->count();
            } else {
                $count = Product::query()->whereBetween('regular_price',[$min, $max])->get()->count();
            }
        }

        return $count;
    }

    private function parsePrice($price)
    {
        return number_format((float) $price, 2, '.' . '');
    }

}
