<?php

namespace Munzevi\Passcon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Munzevi\Passcon\Rules\Password;


class CheckEmailRequest extends FormRequest
{
    public function authorization()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email'
        ];
    }
}
