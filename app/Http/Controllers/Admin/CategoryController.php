<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General\Category;
use App\Traits\StoreImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use StoreImageTrait;

    public function categories()
    {
        $categories = Category::query()->orderBy('category_name', 'ASC')->get();
        return view('admin.category.categories', ['categories' => $categories]);
    }

    public function add_category()
    {
        return view('admin.category.add_category');
    }

    public function store_category(Request $request)
    {
        try {
            $request->validate([
                "category_name" => 'required|string|max:255',
                "category_code" => 'required|string',
                "description" => "string|nullable",
                "image" => "file|mimes:jpg,png,jpeg",
            ]);

            if (request()->hasFile('image') && !is_null($request->image)) {
                $destination = config('global.categories');
                $image_name = $this->store_image("image", $destination);
            }

            $admin = Auth::guard('admin')->user();
            $created_by = Str::title($admin->first_name . " " . $admin->last_name);

            $category = Category::query()->create([
                "category_name" => $request->category_name,
                "category_code" => $request->category_code,
                "description" => !is_null($request->description) ? $request->description : null,
                "created_by" => $created_by,
                'slug' => Str::slug($request->category_name),
                "image" => !is_null($request->image) ? $image_name : null,
            ]);

            if ($category) {
                return redirect()->back()->with('success', 'Great, New Category has been Added');
            }
            return redirect()->back()->with('error', 'Sorry, Category creation encountered a problem, Please try again');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit_category($slug)
    {
        $category = Category::query()->where('slug', $slug)->first();
        if (!$category) {
            return redirect()->back()->with('error', 'Sorry, category to update was not found');
        }
        return view("admin.category.edit_category")->with(['category' => $category]);

    }

    public function update_category(Request $request, $slug)
    {
        try {

            $category = Category::query()->where('slug', $slug)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'Sorry, category to update was not found');
            }

            $request->validate([
                "category_name" => 'required|string|max:255',
                "category_code" => 'required|string',
                "description" => "string|nullable",
                "image" => "file|mimes:jpg,png,jpeg",
            ]);

            $admin = Auth::guard('admin')->user();
            $updated_by = Str::title($admin->first_name . " " . $admin->last_name);

            $old_image = $category->image;

            if (request()->hasFile('image') && !is_null($request->image)) {
                //* store the new image in categories directory
                $destination = config('global.categories');
                $new_image = $this->store_image('image', $destination);

                //* remove the old image
                if (file_exists(public_path($destination . '/' . $old_image))) {
                    unlink(public_path($destination . '/' . $old_image));
                }
            }

            $category_update = $category->update([
                "category_name" => $request->category_name,
                "category_code" => $request->category_code,
                "description" => !is_null($request->description) ? $request->description : null,
                "created_by" => $updated_by,
                "image" => is_null($request->image) ? $old_image : $new_image,
            ]);

            if ($category_update) {
                return redirect()->back()->with('success', 'Great, New Category has been Updated successfully');
            }
            return redirect()->back()->with('error', 'Sorry, Category update encountered a problem, Please try again');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function remove_category($slug)
    {
        try {
            $category = Category::query()->where('slug', $slug)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'Sorry, category to update was not found');
            }

            //* remove the old image
            $destination = config('global.categories');
            $old_image = $category->image;

            if (file_exists(public_path($destination . '/' . $old_image))) {
                unlink(public_path($destination . '/' . $old_image));
            }
            $category->delete();

            return redirect()->back()->with('success', 'Great, Category has been Removed successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
