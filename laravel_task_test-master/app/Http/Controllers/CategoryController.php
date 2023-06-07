<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
class CategoryController extends Controller
{

public function index(){

    $categories = Category::with('posts')->paginate(5);

    return view('user_index');

}


    public function create()
    {
        $posts = Post::simplepaginate();

        return  view('edit', [
            'posts' => $posts
        ]);
    }

    public function store()
    {
        return "Yes";
    }
}
