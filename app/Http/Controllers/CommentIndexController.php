<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return inertia()->render('Comments/Index', [
            'greeting' => 'Hello, World!',
            'posts' => PostResource::collection(Post::query()
                ->with('user')
                ->latest()->get()),
            'can' => [
                'create' => $request->user()?->can('create', Post::class),
            ],
        ]);
    }
}
