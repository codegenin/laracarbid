<?php

namespace App\Http\Resources\Auth;

use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResponseResource extends JsonResource
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
            'access_token' => $this->resource->accessToken,
            'token_type'   => 'Bearer',
            'expires_at'   => Carbon::parse(
                $this->resource->token->expires_at
            )->toDateTimeString()
        ];
    }
}
