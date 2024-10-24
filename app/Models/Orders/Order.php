<?php

namespace App\Models\Orders;

use App\Models\Rating\Rating;
use App\Models\Restaurant\Branch;
use App\Models\Restaurant\Restaurant;
use App\Models\User\Customer;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'user_id');
    }

    public function getAddressAttribute()
    {
        return $this->user->address ?? null; // Adjust this if the address field is named differently
    }
}
