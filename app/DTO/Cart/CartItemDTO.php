<?php

namespace App\DTO\Cart;

use App\DTO\BaseDTO;
use App\Models\Menu\MenuItem;

class CartItemDTO extends BaseDTO
{

    public function __construct(array $data) {
        $this->session_id = $data['session_id'];
        $this->menu_item_id = $data['menu_item_id'];
        $menuItem = MenuItem::find($this->menu_item_id)->first();
        $this->restaurant_id= $menuItem->menu->restaurant->id;
        $this->quantity = $data['quantity'];
        $this->price = $data['price']??0.0;
        $this->choice_group_id = $data['variations'][0]['choice_group_id']??null;
        $this->choice_id = $data['variations'][0]['choice_id']??null;
    }
}
