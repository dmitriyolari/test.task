<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @property Brand $resource
 */
class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => $this->code,
            'displayOnHome' => $this->display_on_home,
            'bannerTitle' => $this->banner_title,
            'bannerDescription' => $this->banner_description,
            'logo' => $this->getFirstMediaUrl('logo')
        ];
    }
}
