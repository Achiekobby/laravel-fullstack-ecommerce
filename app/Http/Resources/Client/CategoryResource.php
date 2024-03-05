<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Client\SubcategoriesResource;
use App\Models\General\Category;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'category_id'=>$this->id,
            'category_name'=>$this->category_name,
            'subcategories'=>!is_null($this->subcategories) ? SubcategoriesResource::collection($this->subcategories) : null
        ];
    }
}
