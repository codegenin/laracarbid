<?php

namespace App\Http\Resources\Vehicle;

use Illuminate\Http\Resources\Json\ResourceCollection;

class QueryUserVehicleResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'status'  => true,
            'message' => 'Success'
        ];
    }
}
