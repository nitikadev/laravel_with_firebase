<?php

namespace App\Http\Resources\admin\customer\select;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output['id'] = $this->id;
        $output['uuid'] = $this->uuid;
        $output['state_name'] = $this->state_name;

        return $output;
    }
}
