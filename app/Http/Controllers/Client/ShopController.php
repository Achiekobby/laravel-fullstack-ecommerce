<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\General\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = request()->input('category') ?? null;
        $brand = request()->input('brand') ?? null;
        $subcategory = request()->input('subcategory') ?? null;

        if (!is_null($category) && is_null($subcategory)) {
            $shop_products = Product::where('category_id', $category)->orderBy('created_at', 'DESC')->paginate(9);
        } elseif (!is_null($category) && !is_null($subcategory)) {
            $shop_products = Product::where('category_id', $category)->where('subcategory_id', $subcategory)->orderBy('created_at', 'DESC')->paginate(9);
        } elseif (!is_null($brand)) {
            $shop_products = Product::where('brand_id', $brand)->orderBy('created_at', 'DESC')->paginate(9);
        } else {
            $shop_products = Product::orderBy('created_at', 'DESC')->paginate(9);
        }
        return view('client.shop', ['products' => $shop_products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $product = Product::query()->where('slug', $slug)->where('status', 'active')->first();
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }
            //* related products
            $related_products = Product::query()->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('status', 'active')
                ->inRandomOrder()
                ->limit(6)
                ->get();

            return view('client.product_details', ['product' => $product, 'related_products' => $related_products]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    //* HELPER METHODS
    
}
