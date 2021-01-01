<?php

namespace Munzevi\Passcon\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;

class VerificationController extends Controller
{
    /**
     * Verify newly registered user's email account
     *
     * @param \App\Models\User $user_id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verify($user_id, Request $request)
    {
        $user = User::findOrFail($user_id);

        if(! $request->hasValidSignature() || $user->hasVerifiedEmail() ){
            return response()->json(['Unauthorization Action'], 401);
        }

        $user->markEmailAsVerified();

        event(new Verified($user));

        return response()->json(['success'],200);
    }

    /**
     * Resend user's verification link if requested
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['Email aldready verified'],422);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['Email verification link has been sent to your e-mail.']);
    }

    public function notice()
    {
        return response()->json(['please verify your email account'], 422);
    }
}
