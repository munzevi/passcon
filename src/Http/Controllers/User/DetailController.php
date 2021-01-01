<?php

namespace Munzevi\Passcon\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Munzevi\Passcon\Http\Resources\UserResource;

class DetailController extends Controller
{
    /**
     * Return authenticated requester user's detail
     *
     * @param \Illuminate\Http\Requestt $request
     * @return \Munzevi\Passcon\Http\Resources\UserResource
     */
    public function show(Request $request)
    {
        return new UserResource($request->user());
    }
}
