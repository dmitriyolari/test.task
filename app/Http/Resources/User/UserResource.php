<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Http\Resources\BaseResource;
use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

/**
 * @property User $resource
 *
 * @property string $name
 * @property string $email
 */
class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
