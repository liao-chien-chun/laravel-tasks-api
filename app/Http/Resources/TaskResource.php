<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // 定義將公開哪些屬性
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_completed' => (bool) $this->is_completed
        ];
    }
}
