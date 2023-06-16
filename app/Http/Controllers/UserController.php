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
    public function index()
    {
        return '11';
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
