<?php

namespace App\Http\Resources\api\customer;

use App\Http\Resources\api\master\CityResource;
use App\Http\Resources\api\master\CompanyResource;
use App\Http\Resources\api\master\IndustryTypeResource;
use App\Http\Resources\api\master\LoanPurposeResource;
use App\Http\Resources\api\master\PincodeResource;
use App\Http\Resources\api\master\StateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerProfessionalInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output['id'] = $this->id;
        $output['company'] = new CompanyResource($this->company);
        $output['industry_type'] = new IndustryTypeResource($this->industryType);
        $output['loan_purpose'] = new LoanPurposeResource($this->loanPurpose);
        $output['pincode'] = new PincodeResource($this->pincode);
        $output['state'] = new StateResource($this->state);
        $output['city'] = new CityResource($this->city);
        $output['address'] = $this->address;


        return $output;
    }
}
