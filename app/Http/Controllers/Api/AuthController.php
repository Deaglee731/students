<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Api authenticate with passport",
     *     description="Api authenticate with passport",
     *     tags={"auth"},
     *     @OA\Parameter(
     *          required=true,
     *          name="email",
     *          description="email address",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="password",
     *          description="password",
     *          in="query",
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="Login sucessfull",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                     property="message",
     *                     type="string",
     *                 ),
     *            @OA\Property(
     *                     property="token",
     *                     type="string",
     *                 ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        $token = $request->user()->createToken($request->email)->accessToken;

        return response()->json([
            'token' => $token,
            'message' => 'Sucessfull',
        ]);
    }

     /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Api authenticate with passport",
     *     description="Api authenticate with passport",
     *     tags={"auth"},
     *      @OA\Response(
     *         response=200,
     *         description="Logout Sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Sucessfull',
        ]);
    }

     /**
     * @OA\Post(
     *     path="/api/reset-password",
     *     description="Api authenticate with passport",
     *     tags={"auth"},
     *     @OA\Parameter(
     *          required=true,
     *          name="email",
     *          description="email address",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Password sent with mail",
     *     ),
     * )
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response()->json([
            'status' => $status,
        ]);
    }
}
