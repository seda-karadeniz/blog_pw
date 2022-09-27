<?php


namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(){


        $filter = request()->only('search','category','user');
        return view('posts.index',[
            'posts' => Post::filter($filter)->latest('published_at')->with('category','user')->paginate(9)->withQueryString(),
            'page_title' =>'la liste des posts',
            //'users' => \App\Models\User::whereHas('posts')->orderBy('name')->get(),
        ]);
    }


    public function show(Post $post){
        //$post = Post::where('slug', $slug)->firstOrFail();

        $page_title = "le post : {$post->title}";

        return view('posts.show', compact('post', 'page_title'));
    }

}

