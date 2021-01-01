<?php

namespace Munzevi\Passcon\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Munzevi\Passcon\Http\Requests\UserUpdateRequest;
use Munzevi\Passcon\Http\Resources\UserResource;

class UpdateController extends Controller
{
    /**
     * Update user informations
     *
     * @param UserUpdateRequest $request
     * @return void
     */
    public function update(UserUpdateRequest $request)
    {
        $this->user()->update($request->all());

        return new UserResource($this->user());
    }
}
