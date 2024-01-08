<?php

namespace App\Http\Resources\api\customer;

use App\Http\Resources\api\master\CityResource;
use App\Http\Resources\api\master\LanguagePreferenceResource;
use App\Http\Resources\api\master\PincodeResource;
use App\Http\Resources\api\master\QualificationResource;
use App\Http\Resources\api\master\StateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerPersonalInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output['id'] = $this->id;
        $output['father_name'] = $this->father_name;
        $output['mother_name'] = $this->mother_name;
        $output['marital_status'] = $this->marital_status;
        $output['stay_in'] = $this->stay_in;
        $output['pincode'] = new PincodeResource($this->pincode);
        $output['state'] = new StateResource($this->state);
        $output['city'] = new CityResource($this->city);
        $output['address'] = $this->address;
        $output['educational_qualification'] = new QualificationResource($this->educationalQualification);
        $output['language_preference'] = new LanguagePreferenceResource($this->languagePreference);

        return $output;
    }
}
