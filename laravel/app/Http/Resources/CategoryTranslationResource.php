<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTranslationResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'language_id' => $this->language_id,
            'name' => $this->name,
        ];
    }
}
