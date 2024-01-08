<?php

namespace App\Http\Resources\api\customer;

use App\Http\Resources\api\master\EmploymentTypeResource;
use App\Http\Resources\api\master\SalaryReceiptResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
        $output['loan_amount'] = $this->loan_amount;
        $output['first_name'] = $this->first_name;
        $output['last_name'] = $this->last_name;
        $output['email'] = $this->email;
        $output['phone'] = $this->phone;
        $output['profile_image_path'] = $this->profile_image_path ? json_decode($this->profile_image_path) : [];
        $output['employment_type'] = new EmploymentTypeResource($this->employmentType);
        $output['monthly_income'] = $this->monthly_income;
        $output['salary_receipt'] = new SalaryReceiptResource($this->salaryReceipt);
        $output['is_new'] = $this->is_new;
        $output['is_eligible'] = $this->is_eligible;
        $output['cibil_score'] = $this->cibil_score;
        $output['basic_details_filled'] = $this->basic_details_filled;
        $output['pan_details_filled'] = $this->pan_details_filled;
        $output['voter_card_details_filled'] = $this->voter_card_details_filled;
        $output['driving_license_details_filled'] = $this->driving_license_details_filled;
        $output['personal_info_filled'] = $this->personal_info_filled;
        $output['professional_info_filled'] = $this->professional_info_filled;
        $output['pan_card_details'] = new CustomerPanCardResource($this->panCard);
        $output['voter_card_details'] = new CustomerVoterCardResource($this->voterCard);
        $output['driving_license_details'] = new CustomerDrivingLicenseResource($this->drivingLicense);
        $output['personal_info'] = new CustomerPersonalInfoResource($this->personalInfo);
        $output['professional_info'] = new CustomerProfessionalInfoResource($this->professionalInfo);
        $output['bank_details'] = new CustomerBankDetailResource($this->bankDetails);

        return $output;
    }
}
