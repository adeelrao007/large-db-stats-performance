<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,

            'translations' => CategoryTranslationResource::collection(
                $this->whenLoaded('translations')
            ),

            'children' => CategoryResource::collection(
                $this->whenLoaded('children')
            ),
        ];
    }
}

