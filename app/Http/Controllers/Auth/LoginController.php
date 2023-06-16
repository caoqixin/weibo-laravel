<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class LoginController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Auth/Login');
    }

    public function auth(Request $request):RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            session()->flash('welcome', "{$user->name},欢迎回来");

            return redirect()->route('users.show', [$user]);
        }

        return back()->withErrors([
            'email' => '很抱歉，您的邮箱和密码不匹配',
        ])->onlyInput('email');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
