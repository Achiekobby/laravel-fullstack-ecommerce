<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General\Category;
use App\Models\General\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_categories = Subcategory::query()->orderBy('name', 'ASC')->get();
        return view('admin.subcategory.subcategories', ['subcategories' => $sub_categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get();
        return view('admin.subcategory.add_subcategory')->with(['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
            $category = Category::query()->where('id', $request->category_id)->first();
            if (!$category) {
                return redirect()->back()->with('error', 'Sorry, the selected category does not exist');
            }

            $sub_category = $category->subcategories()->create([
                'uuid' => Str::uuid(),
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => !is_null($request->description) ? $request->description : null,
                'slug' => Str::slug($request->name),
            ]);

            if ($sub_category) {
                return redirect()->back()->with('success', 'New Subcategory has been added successfully');
            }
            return redirect()->back()->with('error', 'Sorry, subcategory creation encountered a problem. Please try again.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sub_category = Subcategory::query()->where('id', $id)->first();
        $categories = Category::query()->get();
        if (!$sub_category) {
            return redirect()->back()->with('error', 'Sorry, the selected sub-category does not exist');
        }

        return view('admin.subcategory.edit_subcategory')->with(['subcategory' => $sub_category,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
            $sub_category = Subcategory::query()->where('id', $id)->first();
            if (!$sub_category) {
                return redirect()->back()->with('error', 'Sorry, the selected sub-category does not exist');
            }

            $sub_category_update = $sub_category->update([
                'name' => $request->name,
                'description' => !is_null($request->description) ? $request->description : null,
            ]);

            if ($sub_category_update) {
                return redirect()->back()->with('success', 'Subcategory has been updated successfully');
            }
            return redirect()->back()->with('error', 'Sorry, subcategory update encountered a problem. Please try again.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub_category = Subcategory::query()->where('id', $id)->first();
        if (!$sub_category) {
            return redirect()->back()->with('error', 'Sorry, the selected sub-category does not exist');
        }

        $sub_category->delete();
        return redirect()->back()->with('success', 'Subcategory has been removed successfully');

    }
}
