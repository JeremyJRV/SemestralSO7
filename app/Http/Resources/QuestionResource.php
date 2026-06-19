<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question_text' => $this->question_text,
            'type' => $this->type,
            'theme' => $this->theme->name,
            'level' => $this->level->name,
            'options' => $this->options->map(fn($opt) => [
                'id' => $opt->id,
                'text' => $opt->option_text,
                'order' => $opt->order,
            ]),
            'explanation' => $this->explanation,
            'difficulty_score' => $this->difficulty_score,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}