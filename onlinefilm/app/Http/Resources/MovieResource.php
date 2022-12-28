<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    public static $wrap = 'movie';
    public function toArray($request)
    {

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'year' => $this->resource->year,
            'description' => $this->resource->description,
            'genre' => $this->resource->genre,
            'user' => new UserResource($this->resource->user),
            'starring' => $this->resource->actor
        ];
    }
}