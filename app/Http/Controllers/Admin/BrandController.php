<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\StoreImageTrait;

class BrandController extends Controller
{
    use StoreImageTrait;

    public function index(){
        return view('admin.brand.brands',['brands'=>Brand::query()->orderBy('name','ASC')->get()]);
    }

    public function create(){
        return view('admin.brand.add_brand');
    }

    public function store(Request $request){
        try{
            //Todo=>Validation
            $rules = [
                'name'              =>'required|string|max:255',
                'image'             =>'required|file|mimes:jpeg,png,jpg,svg',
                'meta_description'  =>'nullable|string',
                'meta_keywords'     =>'nullable|string'
            ];

            $validation = Validator::make($request->all(),$rules);
            if($validation->fails()){
                return redirect()->back()->with('warning',$validation->errors()->first());
            }

            //Todo=>Handling image storage
            $image_name = null;
            if(!is_null($request->file('image'))){
                $destination    = config('global.brands');
                $image_name     = $this->store_image("image", $destination);
            }

            //Todo=>insert into db-table(brands)
            $brand = Brand::query()->create([
                'name'              =>$request->name,
                'image'             =>$image_name,
                'meta_description'  =>$request->meta_description ?? null,
                'meta_keywords'     =>$request->meta_keywords ?? null,
            ]);

            if($brand){
                return redirect()->back()->with('success','You have successfully added a new brand!!');
            }
            else{
                return redirect()->back()->with('error','Something went wrong.Please try again later!!');
            }

        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function edit($id){
        try{
            $brand = Brand::where('id',$id)->first();
            if(!$brand){
                return redirect()->back()->with('error','Brand not found');
            }
            return view('admin.brand.edit_brand',['brand'=>$brand]);
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function update(Request $request, $id){
        try{
            $rules = [
                'name'              =>'required|string|max:255',
                'image'             =>'file|mimes:jpeg,png,jpg|size:2048',
                'meta_description'  =>'nullable|string',
                'meta_keywords'     =>'nullable|string'
            ];

            $validation = Validator::make($request->all(),$rules);
            if($validation->fails()){
                return redirect()->back()->with('errors',$validation->errors()->first());
            }

            //Todo=>extract brand from db
            $brand = Brand::where('id',$id)->first();
            if(!$brand){
                return redirect()->back()->with('error','Brand not found');
            }

            //Todo=>Handling image storage
            $image_name = $brand->image;
            if($request->hasFile('image') && !is_null($request->file('image'))){

                //?remove the old image
                $this->remove_image($brand->image);
                $destination    = config('global.brands');
                $image_name     = $this->storeImage("image", $destination);

            }

            $brand_update = $brand->update([
                'name'=>$request->name,
                'image'=>$image_name,
                'meta_description'=>$request->meta_description,
                'meta_keywords'=>$request->meta_keywords
            ]);
            if($brand_update){
                return redirect()->back()->with('success','You have successfully update this brand');
            }
            else{
                return redirect()->back()->with('error','Error updating this brand');
            }

        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    public function destroy($id){
        try{
            $brand = Brand::where('id',$id)->first();
            if(!$brand){
                return redirect()->back()->with('error','Brand not found');
            }
            //* remove the image associated with the brand
            $image_removed = $this->remove_image($brand->image);

            if($image_removed){
                $brand->delete();
                return redirect()->back()->with('success','You have successfully removed the brand.');
            }
            return redirect()->back()->with('error','Error while removing the brand');

        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
