<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
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
            'gravatar' => $user->gravatar('140'),
            'can' => [
                'delete' => \request()->user()->can('delete', $user),
            ],
            'link' => route('users.show', $user->id)
        ]);

        return inertia('User/Index', [
            'users' => $user,
            'message' => session()->has('msg') ? session()->get('msg') : ''
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id): Response|ResponseFactory
    {
        $user = User::find($id);
        $articles = $user->articles()->orderBy('created_at', 'desc')->paginate(20)
            ->through(fn($feed) => [
                'id' => $feed->id,
                'content' => $feed->content,
                'created_at' => $feed->created_at,
                'can' => [
                    'delete' => Auth::user()->can('delete', $feed),
                 ]
            ]);;

        return inertia('User/Show', [
            'user' => $user,
            'articles' => $articles,
            'gravatar' => $user->gravatar('140'),
            'profileUrl' => route('users.show', ['user' => $id]),
            'welcome' => session()->has('welcome') ? session()->get('welcome') : '',
            'message' => session()->has('message') ? session()->get('message') : '',
            'statuses' => [
                'articles' => $user->articles()->count(),
                'fans' => [
                    'count' => count($user->fans),
                    'link' => route('users.fans', $user->id)
                ],
                'followings' => [
                    'count' => count($user->followings),
                    'link' => route('users.followings', $user->id)
                ]
            ],
            'can' => [
                'follow' => $user->can('follow', Auth::user())
            ],
            'isFollowing' => Auth::user()->isFollowing($user->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @throws AuthorizationException
     */
    public function edit(string $id): Response|ResponseFactory
    {
        $user = User::find($id);
        // 添加授权
        $this->authorize('update', [$user, User::class]);
        return inertia('User/Edit', [
            'user' => $user,
            'gravatar' => $user->gravatar('140')
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws AuthorizationException|ValidationException
     */
    public function update(Request $request, string $id): RedirectResponse
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
    public function destroy(string $id): RedirectResponse
    {
        $user = User::find($id);
        if (Auth::user()->can('delete', $user)) {
            $user->delete();

            session()->flash('msg', '用户删除成功');
            return back();
        }

        session()->flash('msg', '用户删除失败, 您没有该权限');
        return back();
    }

    public function fans(User $user): Response|ResponseFactory
    {
        $users = $user->fans()->paginate(30)->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'gravatar' => $user->gravatar('140'),
        ]);

        $title = "{$user->name} 的粉丝";

        return inertia('User/ShowFollow', [
            'users' => $users,
            'title' => $title
        ]);
    }

    public function followings(User $user): Response|ResponseFactory
    {
        $users = $user->followings()->paginate(30)->through(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'gravatar' => $user->gravatar('140'),
        ]);

        $title = "{$user->name} 关注的人";

        return inertia('User/ShowFollow', [
            'users' => $users,
            'title' => $title
        ]);

    }
}
