<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Login user",
     *     @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="applocation/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property="email",
     *                      type="string",
     *                      description="User email"
     *                  ),
     *                  @OA\Property(
     *                      property="password",
     *                      type="string",
     *                      description="User password"
     *                  ),
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully"
     *      )
     *  )
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        return response()->json([
           'token' => auth()->user()->createToken('token')->accessToken,
        ]);
    }

    /**
     * @OA\Post(
     *     path="api/logout",
     *     tags={"Auth"},
     *     summary="User logout",
     *     security={{}},
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'You are logout successfully'
        ]);
    }

    /**
     * @OA\Post(
     *     path="api/resetPassword",
     *     tags={"Auth"},
     *     summary="Reset password",
     *     @OA\Parameter(
     *         required=true,
     *         name="email",
     *         description="user email",
     *         in="query",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Reset password",
     *     ),
     *)
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
       $status = Password::sendResetLink($request->only('email'));

       return response()->json([
           'status' => $status
       ]);
    }
}
