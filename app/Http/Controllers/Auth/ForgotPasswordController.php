<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Inertia\Response;
use Inertia\ResponseFactory;

class ForgotPasswordController extends Controller
{
    // 重置密码页面
    public function create(): Response|ResponseFactory
    {
        return inertia('Auth/ForgotPassword', [
            'status' => session('status')
        ]);
    }

    // 重置密码
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
