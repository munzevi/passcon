<?php

namespace Munzevi\Passcon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Munzevi\Passcon\Rules\Password;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !$this->user();
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users,email',
            'password' => [ 'required', 'confirmed', new Password ]
        ];
    }


    /**
     * After validator hook to encrypt user password
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->replace([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            return $this;
        });
    }

    /*
    public function messages()
    {
        return [
            'name.required' => _('passcon/auth/name/required'),
            'name.min' => _('passcon/auth/name/min'),
            'name.max' => _('passcon/auth/name/max'),
            'name.string' => _('passcon/auth/name/string'),
            'email.required' => _('passcon/auth/email/required'),
            'email.email' => _('passcon/auth/email/email'),
            'email.min' => _('passcon/auth/email/min'),
            'email.max' => _('passcon/auth/email/max'),
            'email.unique' => _('passcon/auth/email/unique'),
            'password.required' => _('passcon/auth/password/required'),
            'password.min' => _('passcon/auth/password/min'),
            'password.max' => _('passcon/auth/password/max'),
            'password.confirmed' => _('passcon/auth/password/confirmed')
        ];
    }
    */

}
