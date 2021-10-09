<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\category;
use App\Models\tag;
use Illuminate\Http\Request;
use Image;
use Storage;
use File;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::all();
        $category = category::all();
        $tags = tag::all();
        return view('posts.index',['posts'=>$posts , 'category'=>$category , 'tags'=>$tags]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', category::all())->with('tags', tag::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'featured' => 'required|image',
            'tags' => 'required'
        ]);

        $post = new post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        if( $request->hasFile('featured'))    {
            $featured = $request->file('featured');
            $filename =  'posts/'.time().$featured->getClientOriginalName();
            $post->featured=$filename;
            $location = storage_path('app/public/') . $filename;
            Image::make($featured)->save($location);
        }
        $post->save();
        $post->tags()->attach($request->tags);

        return redirect('/post')->with('success', 'Creating Done successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $post = post::find($post->id);
        $categories = category::all();
        $tags = tag::all();
        return view('posts.edit',['post' => $post , 'category' => $categories , 'tags' => $tags]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);
        if( $request->hasFile('featured'))    {
            Storage::disk('public')->delete($post->featured);
            $featured = $request->file('featured');
            $filename =  'posts/'.time().$featured->getClientOriginalName();
            $post->featured=$filename;
            $location = storage_path('app/public/') . $filename;
            Image::make($featured)->save($location);
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync($request->tags);
        return redirect('/post')->with('success', 'Editing Done successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }

    public function deleted($id)
    {
		$post=post::find($id);
		$post->delete();
		return redirect()->route("post.index")->with('success', 'Deleting Done successfully');
    }

    public function trashed()
    {
        $posts = post::onlyTrashed()->get();
        return view("posts.softdeleted", ['posts'=>$posts]);
    }
    public function hdelete($id)
    {
        $posts = post::withTrashed()->where('id',$id)->first();
        Storage::disk('public')->delete($posts->featured);
        $posts->forceDelete();
        return redirect()->route("post.index")->with('success', 'Permenent Deleted Done successfully');;
    }

    public function restore($id)
    {
        $posts = post::withTrashed()->where('id',$id)->first();
        $posts->restore();
        return redirect()->route("post.index")->with('success', 'Restoring Done successfully');
    }
}
