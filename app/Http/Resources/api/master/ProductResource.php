<?php

namespace App\Http\Resources\api\master;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $output['id'] = $this->id;
        $output['product_name'] = $this->product_name;
        $output['sku_id'] = $this->sku_id;
        $output['hsn_code'] = $this->hsn_code;
        $output['cost_price'] = $this->cost_price;
        $output['tax'] = $this->tax;
        $output['sales_price'] = $this->sales_price;

        return $output;
    }
}
