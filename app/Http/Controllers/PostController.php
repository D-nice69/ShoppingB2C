<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use App\Components\Recusive;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.post.index',compact('posts'));
    }
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.post.create',compact('htmlOption'));
    }
    public function store(Request $request)
    {
        Post::create([
            'title' => $request->title,
            'image' => '',
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'status' => $request->status,
            'content' => $request->content,
            'category_post_id' => $request->parent_id,
        ]);
        return redirect()->route('post.index');
    }
    public function getCategory($parentId)
    {
        $data = CategoryPost::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryPostRecusive($parentId);
        return $htmlOption;
    }
}
