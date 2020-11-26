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
        $all_data = Post::latest()->get();
        return view('frontend.post.blog', [
            'all_data'=> $all_data,
        ]);
    }

    public function blogSinglePage(){
        return view('frontend.post.blog-single');
    }

}
