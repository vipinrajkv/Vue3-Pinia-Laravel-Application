<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
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
            'title' => $this->title,
            'rated' => $this->rated,
            'released' => $this->released,
            'runtime' => $this->runtime,
            'genre' => $this->genre,
            'director' => $this->director,
            'writer' => $this->writer,
            'actors' => $this->actors,
            'plot' => $this->plot,
            'language' => $this->language,
            'country' => $this->country,
            'awards' => $this->awards,
            'poster' => $this->poster,
            'type' => $this->type,
            'images' => $this->images,
        ];
    }
}
