<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameSessionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'theme' => $this->theme->name,
            'level' => $this->level->name,
            'status' => $this->status,
            'score' => $this->score,
            'is_multiplayer' => $this->is_multiplayer,
            'duration' => $this->getDurationInSeconds(),
            'started_at' => $this->started_at->toIso8601String(),
            'ended_at' => $this->ended_at?->toIso8601String(),
        ];
    }
}