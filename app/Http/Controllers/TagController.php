<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = Tag::all();
        return view('admin.post.tag.index', [
            'all_data' => $all_data,
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
        $this->validate($request, [
            'name' => 'required | unique:tags'
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('post-tag.index')->with('success', 'Post Tag Added Successful !');
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
        $edit_data = Tag::find($id);

        return [
            'name' => $edit_data->name,
            'id' => $edit_data->id,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $update_id = $request->id;

        $update = Tag::find($update_id);
        $update -> name = $request->name;
        $update -> slug = Str::slug($request->name);
        $update ->update();
        return redirect()->route('post-tag.index')->with('success', 'Post Tag Updated Successful !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Tag::find($id);
        $delete_data -> delete();
        return redirect()->route('post-tag.index')->with('success', 'Post Tag Deleted Successful !');
    }

    /*
     * Post Tag Unpublished
     */
    public function unpublished($id){
        $data = Tag::find($id);
        $data -> status = "Unpublished";
        $data -> update();
        return redirect()->route('post-tag.index')->with('success', 'Post Tag Status Updated Successful !');
    }

    /*
     * Post Tag Published
     */
    public function published($id){
        $data = Tag::find($id);
        $data -> status = "Published";
        $data -> update();
        return redirect()->route('post-tag.index')->with('success', 'Post Tag Status Updated Successful !');
    }
}
