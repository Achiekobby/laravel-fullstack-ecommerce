<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait StoreImageTrait
{

    public function store_image(string $inputField, $destination)
    {

        $file = request()->file($inputField);

        if (!isset($file)) {return false;}

        $image_name = time() . Str::random(6) . "." . $file->getClientOriginalExtension();

        //* move the image into the destination directory
        $file->move(public_path($destination), $image_name);

        return $image_name;
    }

    public function remove_image($photo)
    {
        if (file_exists(public_path('/uploads/brands/' . $photo))) {

            unlink(public_path('/uploads/brands/' . $photo));

            return true;
        }
        return false;
    }
}
