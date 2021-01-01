<?php

namespace Munzevi\Passcon\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Munzevi\Passcon\Http\Requests\CheckEmailRequest;
use Munzevi\Passcon\Http\Requests\PasswordResetRequest;

class PasswordResetController extends Controller
{
    /**
     * Show a very basic - example - password reset link request form
     *
     * @return \Illuminate\View\View
     */
    public function emailForm()
    {
        return view('passcon::reset-password-mail');
    }

    /**
     * Send password reset link to requester user's email
     *
     * @param \Munzevi\Passcon\Http\Requests\CheckEmailRequest $request
     * @return \Illuminate\Auth\Events\PasswordReset
     */
    public function sendEmail(CheckEmailRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withError(['email' => __($status)]);
    }


    public function resetForm($token)
    {
        return view('passcon::reset-password',['token' => $token ]);
    }

    /**
     * Change user's password as requested
     *
     * @param Munzevi\Passcon\Http\Requests\PasswordResetRequest;
     * @return \Illuminate\Auth\Events\PasswordReset
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();

                $user->setRememberToken(Str::random(60));

                event(new PasswordReset($user));
            }
        );

        return $status == Password::PASSWORD_RESET
            ? response()->json([ 'status' => __($status)], 200)
            : back()->withErrors( [ 'email' => [ __($status) ] ] );
    }
}
