<?php

namespace App\Http\Controllers;

use App\CategoryPost;
use App\Components\Recusive;
use App\Http\Requests\PostRequest;
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
    public function store(PostRequest $request)
    {
        $storePost = [
            'title' => $request->title,
            'image' => '',
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'status' => $request->status,
            'content' => $request->content,
            'category_post_id' => $request->parent_id,
        ];
        $getImage = $request->file('image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/posts',$newImage);
            $storePost['image'] = $newImage;
        }
        toastr()->success('Thêm bài viết thành công');

        Post::create($storePost);
        return redirect()->route('post.index');
    }
    
    public function unactive($id)
    {
        Post::find($id)->update(['status'=>1]);
        toastr()->info('Ẩn bài viết');
        return redirect()->route('post.index');
    }
    public function active($id)
    {
        Post::find($id)->update(['status'=>0]);
        toastr()->info('Hiện bài viết');
        return redirect()->route('post.index');
    }
    public function edit($id)
    {
        $post = Post::find($id);
        $cPost = CategoryPost::where('id',$post->category_post_id)->first();
        $htmlOption = $this->getCategory($cPost->id);
        return view('admin.post.edit',compact('post','htmlOption'));
    }
    public function update($id,PostRequest $request)
    {
        $post = Post::find($id);
        $updatePost = [
            'title' => $request->title,
            'image' => $post->image,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'status' => $request->status,
            'content' => $request->content,
            'category_post_id' => $request->parent_id,
        ];
        $getImage = $request->file('image');
        if(!empty($getImage)){
            $getNameImage = $getImage->getClientOriginalName();
            $nameImage = current(explode('.',$getNameImage));
            $newImage =  $nameImage.rand(0,999) .'.'.$getImage->getClientOriginalExtension();
            $getImage->move('uploads/posts',$newImage);
            $updatePost['image'] = $newImage;
        }
        toastr()->success('Cập nhật bài viết thành công');
        Post::find($id)->update($updatePost);
        return redirect()->route('post.index');
    }
    public function delete($id)
    {
        Post::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ],200);
        return response()->json([
            'code' => 500,
            'message' => 'fail'
        ],500);
    }
    public function getCategory($parentId)
    {
        $data = CategoryPost::all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryPostRecusive($parentId);
        return $htmlOption;
    }
}
