<?php

namespace App\Http\Resources\Restaurant;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantResource extends JsonResource
{
    public function toArray($request)
    {

        $deal = $this->deals->first();
        $discount = $deal ? $deal->discount : 0;
        $averageRating = round($this->ratings->avg('stars'), 2) ?? 0;
        return [
            'id' => $this->id,
            'image' => $this->logo_path,
            'name' => $this->name,
            'cuisine' => $this->cuisine,
            'rating' => $averageRating,
            'discount' => $discount,
            'deliveryTime' => optional($this->branches->first())->delivery_time ?? 'N/A',
            'deliveryFee' => optional($this->branches->first())->delivery_fee ?? 0,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'business_type' => $this->business_type,
        ];
    }
}
