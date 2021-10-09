<?php

namespace App\Http\Controllers;

use App\Models\settings;
use App\Models\post;
use App\Models\tag;
use App\Models\category;
use Illuminate\Http\Request;

class siteUIcontroller extends Controller
{
    public function index()
    {
        return view('index')->with('blog_name' , settings::first()->blog_name)
                            ->with('categories' , category::take(5)->get() )
                            ->with('tags' , tag::take(12)->get() )
                            ->with('first_post' , post::orderBy('created_at','desc')->first())
                            ->with('second_post' , post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first())
                            ->with('third_post' , post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first())
                            ->with('fourth_post' , post::orderBy('created_at','desc')->skip(3)->take(1)->get()->first())
                            ->with('ruby_on_rails',  category::find(6) )
                            ->with('laravel',  category::find(5) )
                            ->with('settings',  settings::first() )
                            ->with('django_python',  category::find(4) )
                            ;

    }

    public function showPost($slug)
    {

        $post      = post::all()->first();
        $slug = $post->title;
        $next_page = post::where('id' , '>' ,$post->id)->min('id');
        $prev_page = post::where('id' , '<' ,$post->id)->max('id');
        return view('posts.show')
                            ->with('tags' , tag::all() )
                            ->with('post' , $post)
                            ->with('next' , post::find($next_page))
                            ->with('prev' , post::find($prev_page))
                            ->with('title' , $post->title)
                            ->with('blog_name' , settings::first()->blog_name)
                            ->with('settings',  settings::first() )
                            ->with('categories' , category::take(5)->get() )   ;

    }



    public function category($id)
    {

        $category      = category::find($id) ;


        return view('categories.category')
                            ->with('tags' , tag::all() )
                            ->with('title' , $category->name)
                            ->with('categories' , category::take(5)->get() )
                            ->with('blog_name' , settings::first()->blog_name)
                            ->with('settings',  settings::first() )
                            ->with('name' , $category->name )
                            ->with('category' , $category )    ;

    }



    public function tag($id)
    {

        $tag      = tag::find($id) ;


        return view('tags.tags')

                            ->with('title' , $tag->tag)
                            ->with('categories' , category::take(5)->get() )
                            ->with('blog_name' , settings::first()->blog_name)
                            ->with('settings',  settings::first() )
                            ->with('name' , $tag->name )

                            ->with('tag' , $tag )    ;

    }



}
