<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index',[
            'posts' => Post::latest()-> paginate(10),
        ]);
    }

    public function postsByCategory (Category $category) : View
    {
        return view('posts.index',[
            // 'posts' => $category -> posts()->paginate (10),
            'posts' => Post::where(
                'category_id', $category->id
            )->latest()->paginate (10),
        ]);
    }

    public function postsByTag (Tag $tag) : View
    {
        return view('posts.index',[
            // 'posts' => $category -> posts()->paginate (10),
            'posts' => Post::whereRelation(
                'tags', 'tags.id', $tag->id
            )->latest()->paginate (10),
        ]);
    }

    public function show(Post $post) : View
    {
        return view('posts.show',[
            'post' => $post,
        ]
        );
    }
}
