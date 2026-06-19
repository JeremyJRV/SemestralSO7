<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThemeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'icon' => $this->icon_path,
            'is_active' => $this->is_active,
            'total_plays' => $this->getTotalPlays(),
            'average_rating' => $this->getAverageRating(),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}