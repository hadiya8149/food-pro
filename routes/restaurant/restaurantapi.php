<?php

use App\Http\Controllers\Menu\ChoiceGroupController;
use App\Http\Controllers\Rating\RatingsController;
use App\Http\Controllers\Restaurant\RestaurantController;
use App\Http\Controllers\Restaurant\RevenueController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'request.logs',], function () {
    Route::controller(ChoiceGroupController::class)->group(function () {
        Route::get('menu/choice-group', 'getChoiceGroupById');
        Route::post('menu/assign-choice-group', 'assignChoiceGroup');
        Route::get('choice-groups', 'getAllChoiceGroups');
        Route::post('/create-choice-group', 'createChoiceGroup');
        Route::delete('delete-choice-group', 'deleteChoiceGroup');
        Route::post('/update-choice-group', 'updateChoiceGroup');

    });

    Route::controller(RatingsController::class)->group(function(){
        // restaurant owner can only view their reviews
        Route::get('/my-reviews', 'viewMyRestaurantRating');
        Route::get('/restaurant-reviews', 'viewRestaurantReviews');
    });
    Route::controller(RevenueController::class)->group(function(){
        Route::get('/my-revenue', 'viewMyRevenue');
        Route::get('/restaurant-revenues', 'viewRestaurantRevenues');
    });
    Route::group(['middleware' => 'api',], function () {
        Route::get('/restaurant', [RestaurantController::class, 'viewRestaurantById']);
        Route::delete('/deactivate-restaurant', [RestaurantController::class, 'deleteRestaurant']);
        Route::post('/update-restaurant', [RestaurantController::class, 'updateRestaurant']);
        Route::post('/restore-restaurant', [RestaurantController::class, 'restoreRestaurant']);

    });

});





/***
 * an example code to follow
 *  https://laraveldaily.com/post/laravel-routes-split-into-separate-files
 */
// Route::middleware(['request.logs', 'jwt'])->group(function () {
// });
Route::get('/hello', function(){
    return 'hello';
});
