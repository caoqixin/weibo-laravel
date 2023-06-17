<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        $user = User::paginate(10)->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'gravatar' => $user->gravatar('140')
        ]);

        return inertia('User/Index', [
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response|ResponseFactory
    {
        return inertia('User/Show', [
            'user' => User::find($id),
            'gravatar' => User::find($id)->gravatar('140'),
            'profileUrl' => route('users.show', ['user' => $id]),
            'welcome' => session()->has('welcome') ? session()->get('welcome') : ''
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response|ResponseFactory
    {
        // 添加授权
        $this->authorize('update', [User::find($id), User::class]);
        return inertia('User/Edit', [
            'user' => User::find($id),
            'gravatar' => User::find($id)->gravatar('140')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 添加授权
        $this->authorize('update', [$request->user(), User::class]);

        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $user = User::find($id);
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = $request->password;
        }
        $user->update($data);
        session()->flash('welcome', '个人资料更新成功！');
        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
