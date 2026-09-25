<?php

namespace Modules\Author\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'               => $this->id,
            'username'         => $this->username,
            'full_name'        => $this->full_name,
            'bio'              => $this->bio,
            'avatar'           => $this->avatar,
            'email'            => $this->email,
            'website_url'      => $this->website_url,
            'location'         => $this->location,
            'is_active'        => $this->is_active,
            'published_at'     => $this->published_at?->toISOString(),
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'author_types'     => $this->whenLoaded('authorTypes', function () {
                return $this->authorTypes->map(fn ($type) => [
                    'id'        => $type->id,
                    'name'      => $type->name,
                    'code'      => $type->code,
                    'color_hex' => $type->color_hex,
                ]);
            }),
            'created_at'       => $this->created_at?->toISOString(),
            'updated_at'       => $this->updated_at?->toISOString(),
        ];
    }
}
