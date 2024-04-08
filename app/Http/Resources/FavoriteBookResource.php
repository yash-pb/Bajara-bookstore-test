<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'book_id' => $this->book_id,
            'book_details' => $this->book,
            // 'book_details' => BookResource::collection($this->favorite),
        ];
    }
}
