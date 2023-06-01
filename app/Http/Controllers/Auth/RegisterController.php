<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Services\User\UserServiceInterface;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
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
     * @param RegisterRequest $registerRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $registerRequest)
    {
        try {
            DB::beginTransaction();
            $user = $this->userService->createUser($registerRequest->form());
            DB::commit();

            return $this->sendResponse(
                ['token' => $user->createToken("API TOKEN")->plainTextToken],
                __('messages.SUCCESSFULLY_REGISTERED'),
                Response::HTTP_CREATED,
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->sendError(__('messages.USER_REGISTRATION_FAILED'));
        }



    }
}
