<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Str;
use Inertia\Response;
use Inertia\ResponseFactory;

class EmailVerifyController extends Controller
{
    public function verify(Request $request): Response|ResponseFactory|RedirectResponse
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME) : inertia('Auth/VerifyEmail', [
                'status' => session('status')
            ]);
    }

    public function emailVerification(EmailVerificationRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $request->fulfill();

        if ($request->user()->hasVerifiedEmail()) {
            $user = $request->user();

            $user->activation_token = Str::random(10);
            $user->activated = true;
            $user->save();
        }


        return redirect('/');
    }

    public function sendEmail(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
