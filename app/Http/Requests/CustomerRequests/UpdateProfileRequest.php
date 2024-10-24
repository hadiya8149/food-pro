<?php

namespace App\Http\Requests\CustomerRequests;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends BaseRequest
{

    public function rules(){


        return [
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:15',
            'email' => 'sometimes|email|unique:users,email',
            'password' => 'sometimes|nullable|min:8',
        ];
    }
}
