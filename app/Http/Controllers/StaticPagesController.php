<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Response;
use Inertia\ResponseFactory;

class StaticPagesController extends Controller
{
    public function home(): ResponseFactory|Response
    {
        $feeds = [];
        // 是否已经登陆
        $isLogin = Auth::check();

        $statuses = [
            'articles' => '',
            'fans' => [
                'count' => '',
                'link' => ''
            ],
            'followings' => [
                'count' => '',
                'link' => ''
            ]
        ];

        if ($isLogin) {
            $feeds = Auth::user()->feed()->paginate(10)->through(fn($feed) => [
                'id' => $feed->id,
                'content' => $feed->content,
                'created_at' => $feed->created_at,
                'user' => $feed->user->name,
                'gravatar' => $feed->user->gravatar('140'),
                'can' => [
                    'delete' => Auth::user()->can('delete', $feed)
                ]
            ]);

            $statuses = [
                'articles' => [
                    'count' => Auth::user()->articles()->count(),
                    'link' => route('users.show', Auth::user()->id)
                ],
                'fans' => [
                    'count' => count(Auth::user()->fans),
                    'link' => route('users.fans', Auth::user()->id)
                ],
                'followings' => [
                    'count' => count(Auth::user()->followings),
                    'link' => route('users.followings', Auth::user()->id)
                ]
            ];
        }

        return inertia('Home', [
            'registerUrl' => route('register'),
            'message' => session()->has('message') ? session()->get('message') : '',
            'feeds' => $feeds,
            'statuses' => $statuses
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
