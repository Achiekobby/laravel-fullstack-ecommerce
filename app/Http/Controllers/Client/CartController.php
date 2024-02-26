<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\General\Cart;
use App\Models\General\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //TODO=> ADD TO CART FEATURE
    public function add_to_cart()
    {

        // dd(request()->all());
        try {
            $rules = [
                "product_id" => 'required|string',
                "quantity" => "required|string",
            ];
            $validation = Validator::make(request()->all(), $rules);
            if ($validation->fails()) {
                return redirect()->back()->with('error', $validation->errors()->first());
            }
            $user = Auth()->guard('user')->user();
            if (!$user) {
                return redirect()->back()->with('error', 'You must be logged in to add an item to cart');
            }

            //* update or create query for adding a new item or existing item to cart
            $prev_total_amount = Cart::where([['user_id', $user->id], ['status', 'unpaid']])->first()->total_amount ?? 0;
            $prev_total_items = Cart::where([['user_id', $user->id], ['status', 'unpaid']])->first()->total_items ?? 0;

            $new_cart_item = DB::transaction(function () use ($user, $prev_total_amount, $prev_total_items) {
                $product = Product::query()->where('id', request()->product_id)->first();
                $item_amount = $product->sales_price === "0.00" ? $product->regular_price : $product->sales_price;

                $cart = Cart::query()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'status' => 'unpaid',
                    ],
                    [
                        'user_id' => $user->id,
                        'total_amount' => number_format((float) $prev_total_amount + ($item_amount * request()->quantity), 2, '.', ''),
                        'total_items' => $prev_total_items,
                        'status' => 'unpaid',
                    ]
                );

                //Todo => Cart item entry
                //? =>compute discount
                $discount = 0;
                if ($product->sales_price == 0.00 || is_null($product->sales_price)) {
                    $discount = 0;
                } else {
                    $discount = ceil((($product->regular_price - $product->sales_price) / $product->regular_price) * 100);
                }

                //?=>Handle the product size and color
                $size = null;
                $color = null;
                $details = [];

                if (request()->has('size') && !is_null(request()->size)) {
                    $size = request()->size;
                    $details['size'] = $size;
                }

                if (request()->has('color') && !is_null(request()->color)) {
                    $color = request()->color;
                    $details['color'] = $color;
                }
                $cart_item_quantity = $cart->cartItems()->where('product_id', request()->product_id)->first()->quantity ?? 0;

                $cart->cartItems()->updateOrCreate(
                    [
                        'product_id' => request()->product_id,
                    ],
                    [
                        'product_id' => request()->product_id,
                        'name' => $product->name,
                        'details' => $details,
                        'quantity' => (int) ($cart_item_quantity + request()->quantity),
                        'item_price' => $product->regular_price,
                        'sales_price' => $product->sales_price,
                        'discount' => $discount,
                    ]
                );

                //Todo=>update the count for the cart items total
                $cart_items_total = $cart->cartItems()->count();
                $cart->update(['total_items' => (int) $cart_items_total]);

                return $cart;
            });
            if ($new_cart_item) {
                return redirect()->back()->with('success', 'Product has been added to cart successfully');
            } else {
                return redirect()->back()->with('error', 'Sorry, Product could not be added to the cart the moment. Please try again later!!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //TODO=> GET USERS CART ITEMS
    public function get_cart_items()
    {
        try {
            $user = Auth::guard('user')->user();
            if (!$user) {
                return redirect()->back()->with('error', 'You must be logged in to access this route');
            }

            $cart = Cart::query()->where('user_id', $user->id)->where('status', 'unpaid')->first();
            return view('client.cart', ['cart' => $cart]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //TODO=>REMOVE AN ITEM FROM CART
    public function removeFromCart($item_id)
    {
        try {

            $user = Auth::guard('user')->user();
            if (!$user) {
                return redirect()->back()->with('error', 'You must be logged in to access this route');
            }
            $cart = Cart::query()->where('user_id', $user->id)->where('status', 'unpaid')->first();
            if (!$cart) {
                return redirect()->back()->with('error', 'You do not have any item in your cart!!');
            }

            $cart_item = $cart->cartItems()->where('product_id', $item_id)->first();
            if (!$cart_item) {
                return redirect()->back()->with('error', 'The item you are trying to delete does not exist!!');
            }
            //? make the necessary quantity changes
            $total_items_left = (int) ($cart->total_items - 1);

            //?compute item amount
            $item_amount = 0;
            if ($cart_item->sales_price !== "0.00") {
                $item_amount = $cart_item->sales_price * $cart_item->quantity;
            } else {
                $item_amount = $cart_item->item_price * $cart_item->quantity;
            }
            $amount_left = number_format((float) ($cart->total_amount - $item_amount), 2, '.', '');

            if ($total_items_left == 0) {
                //?=>remove the cart entry
                $cart->delete();
            } else {
                $cart->update([
                    'total_items' => $total_items_left,
                    'total_amount' => $amount_left,
                ]);

                $cart->cartItems()->where('product_id', $item_id)->delete();
            }
            return redirect()->back()->with('success', 'Item has been successfully removed from cart');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //TODO=> Increase quantity for a cart item
    public function increaseQuantity($item_id)
    {
        try {
            $user = Auth::guard('user')->user();
            if (!$user) {
                return redirect()->back()->with('error', 'You must be logged in to access this route');
            }
            $cart = Cart::query()->where('user_id', $user->id)->where('status', 'unpaid')->first();
            if (!$cart) {
                return redirect()->back()->with('error', 'You do not have any item in your cart!!');
            }

            $cart_item = $cart->cartItems()->where('product_id', $item_id)->first();
            if (!$cart_item) {
                return redirect()->back()->with('error', 'The item you are trying to delete does not exist!!');
            }

            //?compute item quantity
            $new_quantity = (int) ($cart_item->quantity + 1);
            $new_amount = 0;
            if ($cart_item->sales_price === "0.00") {
                $new_amount = number_format((float) ($cart->total_amount + $cart_item->product->regular_price), 2, '.', '');
            } else {
                $new_amount = number_format((float) ($cart->total_amount + $cart_item->product->sales_price), 2, '.', '');
            }

            //*update the cart_total_amount
            $cart->update([
                'total_amount' => $new_amount,
            ]);

            $cart_item->update(['quantity' => $new_quantity]);
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //TODO=> Increase quantity for a cart item
    public function decreaseQuantity($item_id)
    {
        try {
            $user = Auth::guard('user')->user();
            if (!$user) {
                return redirect()->back()->with('error', 'You must be logged in to access this route');
            }
            $cart = Cart::query()->where('user_id', $user->id)->where('status', 'unpaid')->first();
            if (!$cart) {
                return redirect()->back()->with('error', 'You do not have any item in your cart!!');
            }

            $cart_item = $cart->cartItems()->where('product_id', $item_id)->first();
            if (!$cart_item) {
                return redirect()->back()->with('error', 'The item you are trying to delete does not exist!!');
            }

            //?compute item quantity
            $new_quantity = (int) ($cart_item->quantity - 1);
            $total_items = (int) $cart->total_items;

            if ($new_quantity == 0) {
                //?=>remove the item from the list
                $cart_item->delete();
                $total_items -= 1;
            }
            $new_amount = 0;
            if ($cart_item->sales_price === "0.00") {
                $new_amount = number_format((float) ($cart->total_amount - $cart_item->product->regular_price), 2, '.', '');
            } else {
                $new_amount = number_format((float) ($cart->total_amount - $cart_item->product->sales_price), 2, '.', '');
            }

            if ($cart->cartItems()->count() === 0) {

                $cart->delete();

            } else {
                //*update the cart_total_amount
                $cart->update([
                    'total_amount' => $new_amount,
                    'total_items' => $total_items,
                ]);
            }

            $cart_item->update(['quantity' => $new_quantity]);
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
