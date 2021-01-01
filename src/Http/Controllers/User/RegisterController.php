<?php

namespace Munzevi\Passcon\Http\Controllers\User;

use Munzevi\Passcon\Http\Requests\UserStoreRequest;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Validate and create a newly registered user, return user's access token
     *
     * @param \Munzevi\Passcon\Http\Requests\UserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->all());

        $token = $user->createToken('userAccessToken')->accessToken;

        event(new Registered($user));

        return response()->json(['token' => $token], 200);
    }
}
