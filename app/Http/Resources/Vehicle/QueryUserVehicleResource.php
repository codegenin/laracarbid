<?php

namespace App\Http\Resources\Vehicle;

use Illuminate\Http\Resources\Json\JsonResource;

class QueryUserVehicleResource extends JsonResource
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
            'id'           => $this->id,
            'vin_number'   => $this->vin_number,
            'address'      => $this->address,
            'zip'          => $this->zip,
            'make'         => $this->make,
            'model'        => $this->model,
            'year'         => $this->year,
            'mileage'      => $this->mileage,
            'transmission' => $this->transmission,
            'drivetrain'   => $this->drivetrain,
            'color'        => $this->color,
            'trim'         => $this->trim,
            'engine'       => $this->engine_type,
            'fuel'         => $this->fuel_type,
            'auction_type' => $this->auction_type,
            'price'        => $this->price,
            'actioned'     => ($this->auctioned_at) ? $this->auctioned_at->diffForHumans() : '',
            'created'      => $this->created_at->diffForHumans(),
            'updated'      => $this->updated_at->diffForHumans(),
            'category'     => new VehicleCategoryResource($this->whenLoaded('category')),
        ];
    }
}
