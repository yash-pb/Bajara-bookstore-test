<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
 * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // dd($request->sorting);
        // return parent::toArray($request);
        return [
            'data' => $this->collection,
            'meta' => [
                'pagination' => $this->collection->count(),
            ],
            'sorting' => $request->sorting ?? []
        ];

    }
}
