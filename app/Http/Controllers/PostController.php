<?php

namespace App\Http\Controllers;
use App\Post;
use App\Like;
use App\Comment;
use App\Profile;
use App\Follower;
use File;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        $getPost = Post::where('user_id', Auth::id())->first();
        $comment = Comment::with('post')->get();
        $profile = Profile::where('user_id', Auth::id())->first();
        $like = Like::where('user_id', $getPost)->first();
        return view('content.post.all_post', compact('post', 'profile', 'like', 'comment'));
    }

    public function like_post()
    {
        $like = Like::where('user_id', Auth::id())->get();
        $comment = Comment::with('post')->get();
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('content.post.like_post', compact('like', 'profile', 'comment'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('content.post.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
    		'title' => 'required',
    		'description' => 'required',
            'image_url' => 'image|file'
    	]);

        $image = $request->image_url;
        if($image){
            $new_image = time() . ' - ' . $image->getClientOriginalName();
            $image->move('image-upload/', $new_image);
        }else{
            $new_image = null;
        }
        
        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_url' => $new_image,
            'user_id' => Auth::id()
        ]);

    	return redirect('/all_post');
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
        $post = Post::find($id);
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('content.post.edit', compact('post', 'id', 'profile'));
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
        $post = Post::find($id);
        $request->validate([
    		'title' => 'required',
    		'description' => 'required',
            'image_url' => 'image|file'
    	]);

        if($request->image_url){
            File::delete('image-upload/'.$post->image_url);
            $image = $request->image_url;
            $new_image = time() . ' - ' . $image->getClientOriginalName();
            $image->move('image-upload/', $new_image);
            $new_image = $post->image_url;

            $post->update([
                'title' => $request->title,
                'description' => $request->description,
                'image_url' => $new_image,
            ]);

        }else{
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
 
    	return redirect('/all_post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }

    public function add_like($id)
    {
        $post = Post::find($id);

        Like::create([
            'post_id' => $post->id,
            'user_id' => Auth::id()
        ]);

        $post->increment('like');
        return redirect()->back();
    }

    public function remove_like($id)
    {
        $like = Like::find($id);
        Post::find($like->post_id)->decrement('like');
        $like->delete();

        return redirect()->back();
    }

    public function add_comment(Request $request, $id)
    {
        $post = Post::find($id);

        Comment::create([
            'comment' => $request->comment,
            'post_id' => $post->id,
            'user_id' => Auth::id()
        ]);

        $post->increment('comment_amount');

        return redirect()->back();
    }

    public function delete_comment($id)
    {
        $comment = Comment::find($id);
        Post::find($comment->post_id)->decrement('comment_amount');
        $comment->delete();

        return redirect()->back();
    }
}
