<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponder;

class LoginController extends Controller
{
    use ApiResponder;

    /**
     * @var UserServiceInterface
     */
    protected UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $loginRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $loginRequest)
    {
        return $this->userService->login($loginRequest->form())
            ? $this->sendResponse(
                ['token' => Auth::user()->createToken("API TOKEN")->plainTextToken],
                __('messages.LOGIN_SUCCESSFULLY')
            )
            : $this->sendError(__('messages.LOGIN_FAILED'));
    }
}
