<?php

namespace App\Http\Controllers\Restaurant;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequests\UpdateRestaurantRequest;
use App\Services\Restaurant\RestaurantService;

class RestaurantController extends Controller
{
    protected $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    // public function viewRestaurantById()
    // {
    //     try {
    //         $restaurantDetails = $this->restaurantService->getRestaurantWithDetails();
    //         return Helpers::sendSuccessResponse(200, 'Restaurant details retrieved successfully', $restaurantDetails);
    //     } catch (\Exception $e) {
    //         Helpers::createErrorLogs($e, request()->id);
    //         return Helpers::sendFailureResponse(500, 'Failed to retrieve restaurant details');
    //     }
    // }
    public function deleteRestaurant()
{
    try {
        $this->restaurantService->softDeleteRestaurant();

        return Helpers::sendSuccessResponse(200, 'Restaurant deleted successfully');
    } catch (\Exception $e) {
        return Helpers::sendFailureResponse(400, 'Could not delete restaurant');
    }
}

    public function restoreRestaurant()
    {
        try {
            $result = $this->restaurantService->restoreRestaurant();
            return Helpers::sendSuccessResponse(200, 'Restaurant restored successfully', $result);
        } catch (\Exception $e) {
            return Helpers::sendFailureResponse(400, 'Could not restore restaurant');
        }
    }


    public function updateRestaurant(UpdateRestaurantRequest $request)
    {
        // Validate the incoming request




        // Ensure you have validation rules defined







            // Call the service to update the restaurant details
            $this->restaurantService->updateRestaurant($request);
            return Helpers::sendSuccessResponse(200, 'Restaurant updated successfully');

    }

    }
