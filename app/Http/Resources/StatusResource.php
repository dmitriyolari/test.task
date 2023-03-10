<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;

class StatusResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data' => [
                'status' => $this->resource
            ],
        ];
    }
}
