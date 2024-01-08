<?php

namespace App\Http\Resources\api\customer;

use App\Http\Resources\api\master\GenderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerDrivingLicenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output['id'] = $this->id;
        $output['driving_license_no'] = $this->driving_license_no;
        $output['dob'] = $this->dob;
        $output['gender'] = new GenderResource($this->gender);
        $output['address'] = $this->address;
        $output['image_path'] = $this->image_path ? json_decode($this->image_path) : [];
        $output['is_verified'] = $this->is_verified;

        return $output;
    }
}
