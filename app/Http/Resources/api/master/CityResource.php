<?php

namespace App\Http\Resources\api\master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
        $output['name'] = $this->city_name;
        $output['state_id'] = $this->state_id;
        $output['state'] = new StateResource($this->state);

        return $output;
    }
}
