<?php

namespace App\Services\Cart;

use App\DTO\Cart\CartItemDTO;
use App\Helpers\Helpers;
use App\Http\Requests\CartRequests\AddToCartRequest;
use App\Http\Resources\CartResources\AddToCartResource;
use App\Interfaces\CartServiceInterface;
use App\Models\Cart\CartItem;
use App\Models\Restaurant\Restaurant;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CartService implements CartServiceInterface
{
    protected $shoppingSession;
    public function __construct(){
        $this->shoppingSession = ShoppingSessionService::getShoppingSession();
    }

        /***
         * to calculate total of a single product i need to
         * group by the menu item id
         * get the base price of the menu item id ,
         *  get the choice_id additional price
         * multiply the quantity with the menu_item id
         * and add the choice
         */
    public function calculateItemsTotal(){
        try{
            $eachItemsTotal = CartItem::with(['menuItem', 'choice'])
                ->select(
                    'menu_item_id',
                    'quantity',
                    'choice_group_id',
                    'choice_id'
                )
                ->where('session_id', $this->shoppingSession->id)
                ->get()
                ->map(function ($cartItem) {
                    // Calculate total_price and choice_names for each cart item
                    $menuItem = $cartItem->menuItem;
                    $choice = $cartItem->choice??null;
                    $totalPrice = $menuItem->price * $cartItem->quantity;

                    if ($choice)
                    {
                        if($cartItem->ChoiceGroup->choice_type=='size'){
                            $totalPrice = $choice->price * $cartItem->quantity;
                        }
                        else{
                            $totalPrice += $choice->price * $cartItem->quantity; // Add choice price to total
                        }
                        $choiceNames = $choice->name;


                    }
                    else {
                        $choiceNames = null;
                    }

                    return [
                        'menu_item_id' => $cartItem->menu_item_id,
                        'menu_item_name' => $menuItem->name,
                        'quantity' => $cartItem->quantity,
                        'price' => $menuItem->price,
                        'total_price' => $totalPrice,
                        'choice_names' => $choiceNames,
                        'choice_id'=>$choice->id,
                        'choice_group_id'=>$choice->ChoiceGroup->id,
                        'choice_type'=>$choice->ChoiceGroup->choice_type,

                    ];
                });
            return $eachItemsTotal;

        }
catch(\Exception $e){

    Helpers::sendFailureResponse(Response::HTTP_UNPROCESSABLE_ENTITY, __FUNCTION__, $e);
}
        }

    public function addToCart($data){
        $sessionId = $this->shoppingSession;
        $data['session_id'] = $sessionId->id;

        if(!isset($data['variations'])){
            $cartItemDTO = new CartItemDTO($data);
            $cartItem = CartItem::create($cartItemDTO->toArray());
            return $cartItemDTO;
        }
        else{
            $data['variations'] = json_decode($data['variations'], true);
            foreach ($data['variations'] as $variation) {
                $variationData = array_merge($data, $variation);
                $cartItemDTO = new CartItemDTO($variationData);
                $cartItem = CartItem::create($cartItemDTO->toArray());
            }
            return new AddToCartResource($cartItemDTO);
        }
    }

}
