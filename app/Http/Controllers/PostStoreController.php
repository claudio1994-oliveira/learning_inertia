<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        //sleep(2);
        Gate::authorize('create', Post::class);
        $request->validate([
            'body' => ['required', 'string'],
            ['body.required' => 'Esse post é obrigatório.'],
        ]);

        $post = $request->user()->posts()->create($request->only('body'));

        return back()->with('message', [
            'type' => 'success',
            'content' => 'Post criado com sucesso!',
        ]);
    }
}
