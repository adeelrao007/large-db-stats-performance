<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id'     => $this->id,
            'status' => $this->status,

            'category' => new CategoryResource(
                $this->whenLoaded('category')
            ),

            'translations' => ProductTranslationResource::collection(
                $this->whenLoaded('translations')
            ),

            'prices' => ProductPriceResource::collection(
                $this->whenLoaded('prices')
            ),

            'inventory' => new ProductInventoryResource(
                $this->whenLoaded('inventory')
            ),
        ];
    }
}

