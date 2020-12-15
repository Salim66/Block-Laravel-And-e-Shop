<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    public function homePage(){
        return view('frontend.post.home');
    }

    public function blogPostPage(){
        $all_post = Post::latest()->paginate(4);
        return view('frontend.post.blog', [
            'all_post'=> $all_post,
        ]);
    }

    public function blogSinglePage($slug){
        $single_post = Post::where('slug', $slug) -> first();
        return view('frontend.post.blog-single', [
            'single_post' => $single_post,
        ]);
    }

}
