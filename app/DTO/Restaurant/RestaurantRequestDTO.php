<?php

namespace App\DTO\Restaurant;

use App\DTO\BaseDTO;

class RestaurantRequestDTO extends BaseDTO
{

    public function __construct( $data)
    {
        $this->id = $data['id'] ?? 0;  // Set a default of 0 if no ID is passed
        $this->first_name = $data['first_name'];
        $this->last_name = $data['last_name'];
        $this->email = $data['email'];
        $this->address = $data['address'];
        $this->postal_code = $data['postal_code'];
        $this->city = $data['city'];
        $this->opening_time = $data['opening_time'];
        $this->closing_time = $data['closing_time'];
        $this->business_type = $data['business_type'];
        $this->cnic = $data['cnic'];
        $this->bank_name = $data['bank_name'];
        $this->iban = $data['iban'];
        $this->account_owner_title = $data['account_owner_title'];
        $this->cuisine = $data['cuisine'];
        $this->restaurant_name = $data['restaurant_name'];
        $this->logo_path = $data['logo_path'] ?? null;  // Optional logo path
        $this->status = 'pending';
    }
}
