<?php

namespace App\Models\Cart;

use App\Models\Menu\Choice;
use App\Models\Menu\ChoiceGroup;
use App\Models\Menu\MenuItem;
use App\Models\Restaurant\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function shoppingSession()
    {
        return $this->belongsTo(ShoppingSession::class, 'session_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
    public function choiceGroup(){
        return $this->belongsTo(ChoiceGroup::class);

    }
    public function choice(){
        return $this->belongsTo(Choice::class, 'choice_id');
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
