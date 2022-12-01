<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $posts = Post::latest()->paginate(10);
        return  view('post.index' ,compact('posts'));
    }

    public function home()
    {
        if (request('keyword')){
            $posts = Post::when( request("keyword") , function ($query){
                $keyword = request('keyword');
                $query->where("title" , "like" , "%$keyword%")->orWhere( "description" , "like" , "%$keyword%");
            })->get();
        }else{
            $posts = Post::all();
        }
        return  view('home' ,compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {


        $post = new Post();
        $post->title = $request->title;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description , 100 , "....");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if($request->hasFile("featured_image")){
                $imgName = uniqid()."_featured_image_".$request->file("featured_image")->extension();
                $request->file("featured_image")->storeAs("public" , $imgName);

                $post->featured_image  = $imgName;
        }
        $post->save();

        return redirect()->route("post.index")->with("status" , "Post added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  Post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view("post.show" , compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view("post.edit" , compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description , 100 , "....");
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        if($request->hasFile("featured_image")){
            //delete photo
            Storage::delete("public/".$post->featured_image);

            $imgName = uniqid()."_featured_image_".$request->file("featured_image")->extension();
            //save photo
            $request->file("featured_image")->storeAs("public" , $imgName);

            //save photo at db
            $post->featured_image  = $imgName;
        }
        $post->update();

        return redirect()->route("post.index")->with("status" , "Post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(isset($post->featured_image)){
            Storage::delete("public/".$post->featured_image);
        }
        $post->delete();

        return redirect()->route("post.index")->with("status" , "Post deleted succcssfully");
    }
}
