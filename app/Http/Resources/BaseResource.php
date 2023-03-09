<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    /**
     * @var mixed
     */
    protected int $status_code;

    /**
     * @param $status_code
     *
     * @return $this
     */
    public function withStatusCode($status_code): self
    {
        $this->status_code = $status_code;
        return $this;
    }
}
