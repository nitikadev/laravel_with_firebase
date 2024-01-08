<?php

namespace App\Http\Resources\api\master;

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
        $output['name'] = $this->state_name;
        $output['country_id'] = $this->country_id;
        $output['country'] = new CountryResource($this->country);

        return $output;
    }
}
