<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'content' => 'required|max:200'
        ]);

        Auth::user()->articles()->create([
            'content' => $request->get('content')
        ]);

        return redirect()->back()->with('message', '动态发布成功');
    }


    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $id): RedirectResponse
    {
        $article = Article::find($id);

        $this->authorize('delete', $article);

        $article->delete();

        return back()->with('message', '动态删除成功');
    }
}
