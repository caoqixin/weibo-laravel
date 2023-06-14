<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class StaticPagesController extends Controller
{
    public function home(): ResponseFactory|Response
    {
        return inertia('Home');
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
