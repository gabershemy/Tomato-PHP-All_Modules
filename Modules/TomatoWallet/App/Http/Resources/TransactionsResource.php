<?php

namespace Modules\TomatoWallet\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'amount' => (float)$this->amount,
            'type' => $this->type,
            'confirmed' => (bool)$this->confirmed,
            'description' => $this->meta['reason'] ?? null,
            'created_at' => $this->created_at->toDateString(),
            'updated_at' => $this->updated_at->toDateString(),
        ];
    }
}
