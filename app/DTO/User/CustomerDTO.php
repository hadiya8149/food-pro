<?php

namespace App\DTO\User;

use App\DTO\BaseDTO;

class CustomerDTO extends BaseDTO
{
    public ?int $user_id;
    public ?string $address;
    public ?string $delivery_address;
    public $favorites; // This can be array or string

    public function __construct( $data)
    {
        $this->user_id = $data['user_id'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->delivery_address = $data['delivery_address'] ?? null;
        $this->favorites = $data['favorites'] ?? null;
    }
}
