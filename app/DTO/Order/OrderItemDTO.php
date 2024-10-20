<?php

namespace App\DTO\Order;

use App\DTO\BaseDTO;

class OrderItemDTO extends BaseDTO
{
    // what should be in order items
    public function __construct(array $data) {
        $this->order_id = $data['id'];
        $this->menu_item_id = $data['menu_item_id'];
        $this->quantity = $data['quantity'];
        $this->item_price = $data['price'];
        $this->addon_price =  $data['total_price']- $data['price'];
        $this->total_price = $data['total_price'];
        $this->addon_name = $data['choice_names']??null;
//        $this->discount = $data['discount']??null;
        //// if discount then  $this->total_price =($data['total_price']) -$data['total_price']*$this->discount -
    }
}

