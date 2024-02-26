<?php

namespace App\Providers;

use App\Http\Resources\Client\CategoryResource;
use App\Models\General\Cart;
use App\Models\General\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;



class ViewServiceProvider extends ServiceProvider
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
        Facades\View::composer('client_layout.app', function(View $view){
            if(!Auth::guard('user')->check()){
                return redirect()->route('login');
            }
            $categories = CategoryResource::collection(Category::query()->orderBy('created_at','DESC')->get());
            $cart = Cart::where('user_id',Auth::guard('user')->user()->id)->where('status','unpaid')->first() ?? null;


            $view->with(['categories' => $categories,'cart'=>$cart]);
        });
    }
}
