<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Post::latest() -> get();
        $categories = Category::all();
        return view('admin.post.index', [
            'all_data' => $all_data,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        //Image Upload
        if ($request -> hasFile('featured_image')){
            $img = $request->file('featured_image');
            $file_name = md5(time().rand()).".". $img->getClientOriginalExtension();
            $img->move(public_path('media/posts'), $file_name);
        }else {
            $file_name = '';
        }

        $user_post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'featured_image' => $file_name,
        ]);

        $user_post -> categories() -> attach($request->category);

        return redirect()->route('post.index')->with('success', 'Post Added Successful !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Post::find($id);
        $data -> delete();
        unlink('media/posts/'.$data->featured_image);
        return redirect()->route('post.index')->with('success', 'Post Deleted Successful !');
    }

    /*
     * Post Status Unpublished
     */
    public function unpublished($id){
        $data = Post::find($id);
        $data -> status = "Unpublished";
        $data -> update();
        return redirect()->route('post.index')->with('success', 'Post Status Unpublished Successful !');
    }

    /*
     * Post Status Published
     */
    public function published($id){
        $data = Post::find($id);
        $data -> status = "Published";
        $data -> update();
        return redirect()->route('post.index')->with('success', 'Post Status Published Successful !');
    }
}
