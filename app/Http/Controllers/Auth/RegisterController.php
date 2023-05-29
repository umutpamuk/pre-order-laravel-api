<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponder;

class RegisterController extends Controller
{
    use ApiResponder;

    /**
     * @param RegisterRequest $registerRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $registerRequest)
    {
        $user = User::create($registerRequest->form());

        return $this->sendResponse(
            ['token' => $user->createToken("API TOKEN")->plainTextToken],
            'User Created Successfully',
        );
    }
}
