<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostStoreController extends Controller
{

    public function __invoke(Request $request)
    {
        //sleep(2);
        $request->validate([
            'body' => ['required', 'string'],
            ['body.required' => 'Esse post é obrigatório.'],
        ]);

        $post = $request->user()->posts()->create($request->only('body'));

        return back();
    }
}
