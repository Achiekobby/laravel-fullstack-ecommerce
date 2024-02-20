<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General\Category;
use App\Models\General\Product;
use App\Models\General\Subcategory;
use App\Traits\StoreImageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    use StoreImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->orderBy('created_at', 'DESC')->get();
        return view('admin.product.products', ['products' => $products]);
    }

    public function getSubcategories($category)
    {
        $subcategories = Subcategory::where('category_id', $category)->get();
        return response()->json($subcategories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get();

        return view('admin.product.add_product', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $request->validate([
                "product_name" => "required|string|max:255",
                "category_id" => "required",
                "subcategory_id" => "required",
                "brand" => "nullable|string",
                "regular_price" => "required",
                "sales_price" => "required",
                "discount" => "required",
                "quantity" => "required",
                "description" => 'required',
                "status" => "required|string",
                "image_one" => "required",
            ]);

            //* handle images
            $image_names = [];
            $image_destination = config('global.product_images');

            if ($request->hasFile('image_one') && !is_null($request->image_one)) {

                $image_one_name = $this->store_image("image_one", $image_destination);
                if ($image_one_name) {
                    $image_names["image_one"] = $image_one_name;
                }
            }
            if ($request->hasFile('image_two') && !is_null($request->image_two)) {

                $image_two_name = $this->store_image("image_two", $image_destination);
                if ($image_two_name) {

                    $image_names["image_two"] = $image_two_name;
                }

            }
            if ($request->hasFile('image_three') && !is_null($request->image_three)) {

                $image_three_name = $this->store_image("image_three", $image_destination);
                if ($image_three_name) {
                    $image_names["image_three"] = $image_three_name;
                }

            }
            if ($request->hasFile('image_four') && !is_null($request->image_four)) {

                $image_four_name = $this->store_image("image_four", $image_destination);
                if ($image_four_name) {
                    $image_names["image_four"] = $image_four_name;
                }

            }

            if (count($image_names) === 0) {
                return redirect()->back()->with('error', 'You must upload at least one image for the product');
            }

            //*Query the DB table
            $product = Product::query()->create([
                "uuid" => Str::uuid(),
                "category_id" => $request->category_id,
                "subcategory_id" => $request->subcategory_id,
                "admin_id" => Auth::guard('admin')->user()->id,
                "brand" => !is_null($request->brand) ? $request->brand : null,
                "name" => $request->product_name,
                "slug" => Str::slug($request->product_name),
                "regular_price" => number_format((float) $request->regular_price, 2, '.', ''),
                "sales_price" => number_format((float) $request->sales_price, 2, '.', ''),
                "discount_percentage" => $request->discount,
                "quantity" => (int) $request->quantity,
                "description" => $request->description,
                "photos" => $image_names,

            ]);

            if ($product) {
                return redirect()->back()->with('success', 'Great, new product has been added');
            }
            return redirect()->back()->with('error', 'Sorry, Product creation encountered a problem, Please try again later.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $product = Product::query()->where('slug', $slug)->first();
            if (!$product) {
                return redirect()->back()->with('error', 'Sorry, the details for this product does not exist');
            }
            return view('admin.product.view_product', ['product' => $product]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $product = Product::query()->where('uuid', $uuid)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }
        return view('admin.product.edit_product')->with(['product' => $product]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        try {

            //* validation
            $request->validate([
                "product_name"      => "required|string|max:255",
                "category_id"       => "required",
                "subcategory_id"    => "required",
                "brand"             => "nullable|string",
                "regular_price"     => "required",
                "sales_price"       => "required",
                "discount"          => "required",
                "quantity"          => "required",
                "description"       => 'required',
                "status"            => "required|string",
                "image_one"         => "file|mimes:jpg,jpeg,png",
                "image_two"         => "file|mimes:jpg,jpeg,png",
                "image_three"       => "file|mimes:jpg,jpeg,png",
                "image_four"        => "file|mimes:jpg,jpeg,png",
            ]);
            // dd($request->all());


            //? find the product
            $product = Product::query()->where('uuid', $uuid)->first();
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found');
            }

            //* handle images
            $image_destination = config('global.product_images');
            $image_names = $product->photos;

            if ($request->hasFile('image_one') && !is_null($request->image_one)) {
                $image_one = $this->handleImageUpdateRequest($product, "image_one",$image_destination);
                // dd($image_one);
                if(!is_null($image_one)){
                    $image_names["image_one"]= $image_one;
                }
            }
            // dd($image_names);

            if ($request->hasFile('image_two') && !is_null($request->image_two)) {
                $image_two = $this->handleImageUpdateRequest($product, "image_two",$image_destination);
                if(!is_null($image_two)){
                    $image_names["image_two"]= $image_two;
                }
            }

            if ($request->hasFile('image_three') && !is_null($request->image_three)) {
                $image_three = $this->handleImageUpdateRequest($product, "image_three",$image_destination);
                if(!is_null($image_three)){
                    $image_names["image_three"]= $image_three;
                }
            }
            if ($request->hasFile('image_four') && !is_null($request->image_four)) {
                $image_four = $this->handleImageUpdateRequest($product, "image_four",$image_destination);
                if(!is_null($image_four)){
                    $image_names["image_four"]= $image_four;
                }
            }

            if (count($image_names) === 0) {
                return redirect()->back()->with('error', 'You must upload at least one image for the product');
            }

            //* upload query
            $product_update = $product->update([
                "category_id"               => $request->category_id,
                "subcategory_id"            => $request->subcategory_id ?? $product->subcategory_id,
                "brand"                     => !is_null($request->brand) ? $request->brand : $product->brand,
                "name"                      => $request->product_name,
                "slug"                      => Str::slug($request->product_name),
                "regular_price"             => number_format((float) $request->regular_price, 2, '.', ''),
                "sales_price"               => number_format((float) $request->sales_price, 2, '.', ''),
                "discount_percentage"       => $request->discount,
                "quantity"                  => (int) $request->quantity,
                "description"               => $request->description,
                "photos"                    => $image_names,
            ]);

            if($product_update){
                return redirect()->route('admin.products')->with('success',"Great you have successfully updated {$product->name}");
            }
            else{
                return redirect()->back()->with('error','Sorry, a problem occurred during the update of the product. Please try again later');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        try {
            //? finding the product
            $product = Product::query()->where('slug', $slug)->first();
            if (!$product) {
                return redirect()->back()->with('error', 'Product not found. Please try again!');
            }

            //* remove images attached to the product
            // foreach ($product->photos as $key => $photo) {
            //     $imageName = $photo;
            //     if (file_exists(public_path('/uploads/products/'.$imageName))) {
            //         unlink(public_path('/uploads/products/'.$imageName));
            //     }
            // }

            $product->delete();
            return redirect()->back()->withSuccess('Great, You have successfully removed this product');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Handle images during a product update.
     */
    public function handleImageUpdateRequest(Product $product, string $image_number, $destination){

        $uploaded_image_name =null;
        if (array_key_exists($image_number, $product->photos)) {
            $image_name = $this->store_image($image_number, $destination);
            if ($image_name) {
                //* remove the image from the product images directory
                $imageName = $product->photos[$image_number];
                if (file_exists(public_path('/uploads/products/'.$imageName))) {
                    unlink(public_path('/uploads/products/'.$imageName));
                }
                $uploaded_image_name = $image_name;
            }
            else{
                $uploaded_image_name= $product->photos[$image_number];
            }
        }
        else{
            $image_name = $this->store_image($image_number, $destination);
            if ($image_name) {
                $uploaded_image_name = $image_name;
            }
            else{
                $uploaded_image_name = null;
            }
        }

        return $uploaded_image_name;
    }

    /**
     * Promote a product
     */

    public function promote_product($uuid, $promo_value){
        try {
            //* find the product to be promoted
            $product = Product::query()->where('uuid',$uuid)->first();
            if(!$product){
                return redirect()->back()->with('error','Product not found');
            }
            if($promo_value ==="un-promote"){
                $product->promotion()->delete();
                return redirect()->back()->with('success','Great, This product has been removed from the promotion list');
            }

            if($promo_value ==="promote"){
                $product->promotion()->create();
                return redirect()->back()->with('success','Great, This product has been successfully promoted');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}

