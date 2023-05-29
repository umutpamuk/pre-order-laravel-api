<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ApiResponder;

class LoginController extends Controller
{
    use ApiResponder;

    /**
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        if (!Auth::attempt($loginRequest->only(['email', 'password']))) {

            return $this->sendError(
                'Email & Password does not match with our record.',
                Response::HTTP_UNAUTHORIZED
            );
        }

        $user = User::where('email', $loginRequest->email)->first();

        return $this->sendResponse(
            ['token' => $user->createToken("API TOKEN")->plainTextToken],
            'User Logged In Successfully',
        );

    }
}
