<?php

namespace App\Http\Resources\api\master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppLanguagePreferenceResource extends JsonResource
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
        $output['language_name'] = $this->language_name;
        $output['language_shortcode'] = $this->language_shortcode;

        return $output;
    }
}
