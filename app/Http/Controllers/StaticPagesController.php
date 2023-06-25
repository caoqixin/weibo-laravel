<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class StaticPagesController extends Controller
{
    public function home(): ResponseFactory|Response
    {
        $feeds = [];

        if (Auth::check()) {
            $feeds = Auth::user()->feed()->paginate(10);
        }

        return inertia('Home', [
            'registerUrl' => route('register'),
            'message' => session()->has('message') ? session()->get('message') : '',
            'feeds' => $feeds
        ]);
    }

    public function about(): ResponseFactory|Response
    {
        return inertia('About');
    }

    public function help(): ResponseFactory|Response
    {
        return inertia('Help');
    }
}
