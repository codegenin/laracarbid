<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'        => $this->full_name,
            'email'       => $this->email,
            'business'    => $this->profile->business_name,
            'license'     => $this->profile->license_number,
            'dealer_bond' => $this->profile->deale_bond,
            'dealer_type' => $this->profile->deale_type,
            'zip'         => $this->profile->zipcode,
            'mobile'      => $this->profile->mobile,
        ];
    }
}
