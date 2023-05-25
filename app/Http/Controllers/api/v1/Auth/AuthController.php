<?php

namespace App\Http\Controllers\api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponder;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(Request $request)
    {
        try {

            $validateUser = Validator::make($request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {

                return $this->sendError(
                    $validateUser->errors(),
                    Response::HTTP_UNAUTHORIZED
                );
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return $this->sendResponse(
                ['token' => $user->createToken("API TOKEN")->plainTextToken],
                'User Created Successfully',
            );

        } catch (\Throwable $th) {

            return $this->sendError(
                $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {

                return $this->sendError(
                    $validateUser->errors(),
                    Response::HTTP_UNAUTHORIZED
                );
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {

                return $this->sendError(
                    'Email & Password does not match with our record.',
                    Response::HTTP_UNAUTHORIZED
                );
            }

            $user = User::where('email', $request->email)->first();

            return $this->sendResponse(
                ['token' => $user->createToken("API TOKEN")->plainTextToken],
                'User Logged In Successfully',
            );


        } catch (\Throwable $th) {

            return $this->sendError(
                $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );

        }
    }
}
