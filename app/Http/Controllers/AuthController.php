<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AuthController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('Auth/Register');
    }
}
