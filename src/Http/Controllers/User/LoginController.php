<?php

namespace Munzevi\Passcon\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Munzevi\Passcon\Http\Requests\UserLoginRequest;

class LoginController extends Controller
{
    /**
     * Authenticate user and return token if credentials are valid
     *
     * @param UserLoginRequest $request
     * @return Laravel\Passport\Token $accessToken
     */
    public function login(UserLoginRequest $request)
    {
        Auth::attempt($request->all());

        $token = Auth::user()->createToken('accessToken')->accessToken;

        return response()->json(['accessToken' => $token],200);
    }

    /**
     * Logged out requested authenticated user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        dd(request()->user()->token()->accessToken);

        return response()->json(['Logged out'],204);
    }

    /**
     * Store user access token. It is meant to be used also register class
     *
     * @param Laravel\Passport\Token $accessToken
     * @return Laravel\Passport\Token $accessToken
     */
    public static function storeToken($token)
    {
        return request()->user()->update([
            'accessToken' => $token
        ]);
    }
}
