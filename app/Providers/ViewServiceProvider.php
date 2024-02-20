<?php

namespace App\Providers;

use App\Http\Resources\Client\CategoryResource;
use App\Models\General\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
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
            $categories = CategoryResource::collection(Category::query()->orderBy('created_at','DESC')->get());
            $view->with(['categories' => $categories]);
        });
    }
}
