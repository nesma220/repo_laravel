<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
class PostController extends Controller
{
    public function index()
    {
        // $data = $request->all();
        // return $data;

        $posts = Post::paginate(5);

        return view('main_test', [
            'posts' => $posts
        ]);
    }
    public function create()
    {
        $category  = Category::all();
        $tags = Tag::all();
        $user = User::all();

        return view('add_post', [
            'category' =>   $category,
            'tags' =>    $tags,
        ]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required',
            'post_img' => 'nullable|image',
            'file' => 'nullable|file'

        ]);
        $posts = new Post();

        // $data = $request->all();

        if ($request->hasFile('post_img')) {
            $file = $request->file('post_img');

            // $data['post_img'] =  $file->store('images', 'public');
            $posts->post_img = $file->store('images', 'public');
        }
        // Handle the file file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // $data['file'] = $file->store('file', 'public');
            $posts->file = $file->store('images', 'public');

        }
        // $data['user_id'] = auth()->user()->id;
        $posts->title = $request->title;
        $posts->category_id = $request->category_id;
        $posts->details = $request->details;
        $posts->type = 1;
        $posts->user_id = auth()->user()->id;
        $posts->save();
        // $post = Post::create($data);
        $posts->tags()->attach($request->tags_id);
        return redirect()->back()->with([
            'message_flash' => 'تم إضافة المنشور بنجاح',
            'alter' => 'success'
        ]);
    }


    public function delete($id)
    {
        $post = Post::findorfail($id);
        $post->delete();
        return redirect()->back()->with([
            'message_flash' => 'تم حذف المنشور بنجاح',
            'alter' => 'success'
        ]);
    }

    public function edit($id)
    {
        $post = Post::findorfail($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request, $id)
    {

        $post = Post::findorfail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required',
            'category_id' => 'required|int|exists:categories,id',
            'post_img' => 'nullable|image',
            'type' => 'in:0,1',
        ]);
        $data = $request->all();
        $data['user_id'] = 12;
        if ($request->hasFile('post_img')) {
            $file = $request->file('post_img');
            $data['post_img'] =  $file->store('images', 'public');
        }
        $post = Post::findorfail($id);
        $post->update($data);
        $post->tags()->detach($request->tags_id);

        return redirect()->back()->with([
            'message_flash' => 'تم تعديل المنشور بنجاح',
            'alter' => 'success'
        ]);
    }
}
