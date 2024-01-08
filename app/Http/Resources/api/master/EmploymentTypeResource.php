<?php

namespace App\Http\Resources\api\master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmploymentTypeResource extends JsonResource
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
        $output['name'] = $this->employment_name;

        return $output;
    }
}
