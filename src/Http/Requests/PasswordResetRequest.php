<?php

namespace Munzevi\Passcon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Munzevi\Passcon\Rules\Password;


class PasswordResetRequest extends FormRequest
{
    public function authorization()
    {
        return true;
    }

    public function rules()
    {
        $user = \App\Models\User::where('email',$this->email)->first();
        return [
            'token' => 'required',
            'email' => [
                'required',
                'email',
                'unique:users,email,'.$user->id
            ],
            'password' => [
                'required',
                'confirmed',
                new Password
            ]
        ];
    }
}
