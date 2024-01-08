<?php

namespace App\Http\Resources\api\customer;

use App\Http\Resources\api\master\BankResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerBankDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output['id'] = $this->id;
        $output['bank'] = new BankResource($this->bank);
        $output['name'] = $this->name;
        $output['address'] = $this->address;
        $output['account_no'] = $this->account_no;
        $output['ifsc_code'] = $this->ifsc_code;
        $output['is_verified'] = $this->is_verified;

        return $output;
    }
}
