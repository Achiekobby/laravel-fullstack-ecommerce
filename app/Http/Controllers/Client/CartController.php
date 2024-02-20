<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\General\Cart;
use App\Models\General\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //TODO=> ADD TO CART FEATURE
    public function add_to_cart(){
        try {
            $rules =[
                "product_id"=>'required|string',
                "quantity"  =>"required|string",
                "details"   =>'nullable'
            ];
            $validation = Validator::make(request()->all(),$rules);
            if($validation->fails()){
                return redirect()->back()->with('error',$validation->errors()->first());
            }
            $user = Auth()->guard('user')->user();
            if(!$user){
                return redirect()->back()->with('error','You must be logged in to add an item to cart');
            }

            //* update or create query for adding a new item or existing item to cart
            $prev_total_amount = Cart::where([['user_id',$user->id],['status','unpaid']])->first()->total_amount ?? 0;
            $prev_total_items  = Cart::where([['user_id',$user->id],['status','unpaid']])->first()->total_items  ?? 0;

            $new_cart_item = DB::transaction(function() use($user, $prev_total_amount, $prev_total_items){
                $product = Product::query()->where('id',request()->product_id)->first();
                $item_amount = $product->sales_price ==0.00 ? $product->regular_amount : $product->sales_price;

                $cart = Cart::query()->updateOrCreate(
                    [
                        'user_id'=>$user->id,
                        'status'=>'unpaid'
                    ],
                    [
                        'user_id'       =>$user->id,
                        'total_amount'  =>number_format((float)$prev_total_amount + ($item_amount * request()->quantity),2,'.',''),
                        'total_items'   =>$prev_total_items,
                        'status'        =>'unpaid'
                    ]
                );

                //Todo => Cart item entry
                //? =>compute discount
                $discount = 0;
                if($product->sales_price == 0.00 || is_null($product->sales_price)){
                    $discount = 0;
                }
                else{
                    $discount = (($product->regular_price - $product->sales_price)/$product->regular_price)*100;
                }

                $cart->cartItems()->updateOrCreate(
                    [
                        'product_id'=>request()->product_id
                    ],
                    [
                        'product_id'    =>request()->product_id,
                        'name'          =>$product->name,
                        'details'       =>!is_null(request()->details) ? request()->details : null,
                        'quantity'      =>(int)request()->quantity,
                        'item_price'    =>$product->regular_price,
                        'sales_price'   =>$product->sales_price,
                        'discount'      =>$discount,
                    ]
                );

                //Todo=>update the count for the cart items total
                $cart_items_total = $cart->cartItems()->count();
                $cart->update(['total_items'=>(int)$cart_items_total]);

                return $cart;
            });
            if($new_cart_item){
                return redirect()->back()->with('success','Product has been added to cart successfully');
            }
            else{
                return redirect()->back()->with('error','Sorry, Product could not be added to the cart the moment. Please try again later!!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    //TODO=>
}
