<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;
use App\Post;
use App\Like;
use App\Comment;
use App\Follower;
use App\User;
use App\Profile;

class ProfileController extends Controller
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
        $post = Post::where('user_id', Auth::id())->get();
        $comment = Comment::with('post')->get();
        $profile = Profile::where('user_id', Auth::id())->first();
        $count = Post::where('user_id', Auth::id())->count();
        $follow = Follower::where('follow_id', Auth::id())->count();
        $follower = Follower::where('user_id', Auth::id())->count();
        return view('content.profile.index', compact('post', 'profile', 'comment', 'count', 'follow', 'follower'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.profile.create');
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
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'bio' => 'required',
            'thumbnail_url' => 'mimes:jpeg,jpg,png|max:2200'
            
        ]);

        $photo = $request->thumbnail_url;
        $new_photo = time() . ' - ' . $photo->getClientOriginalName();

        
        $user_id= Auth::id();
        
        Profile::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'bio' => $request->bio,
            'thumbnail_url' => $new_photo,
            'user_id' => $user_id
        ]);

        $photo->move('image-upload/', $new_photo);

        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('user_id', Auth::id())->first();
        $user = Profile::where('user_id', $id)->first();
        $getFollow = Follower::where('user_id', $id)->where('follow_id', Auth::id())->value('follow_id');
        $post = Post::where('user_id', $id)->get();
        $comment = Comment::with('post')->get();
        $count = Post::where('user_id', $id)->count();
        $follow = Follower::where('follow_id', $id)->count();
        $follower = Follower::where('user_id', $id)->count();
        return view('content.profile.show', compact('post', 'profile', 'user', 'comment', 'count', 'follow', 'follower', 'getFollow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::where('user_id',$id)->first();
        return view('content.profile.edit', compact('profile'));
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
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'date_of_birth' => 'required',
            'bio' => 'required',
            'thumbnail_url' => 'mimes:jpeg,jpg,png|max:2200'
            
        ]);

        $profile = Profile::findorfail($id);
        if ($request->has('thumbnail_url')) {
            File::delete("image-upload/".$profile->thumbnail_url);
            $photo = $request->thumbnail_url;
            $new_photo = time() . ' - ' . $photo->getClientOriginalName();
            $photo->move('image-upload/', $new_photo);
            $profile_data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'bio' => $request->bio,
                'thumbnail_url' => $new_photo,
            ];
        } else {
            $profile_data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'date_of_birth' => $request->date_of_birth,
                'address' => $request->address,
                'bio' => $request->bio
            ];
        }

        
        $profile->update($profile_data);

        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function follow($id){
        Follower::create([
            'follow_id' => Auth::id(),
            'user_id' => $id
        ]);
        return redirect()->back();
    }

    public function unfollow($id){
        $user = User::find($id);
        $follow = Follower::where('follow_id', $user->id)->first();
        $follow->delete();
        return redirect()->back();
    }

    public function list_follow()
    {
        $follow = Follower::where('follow_id', Auth::id())->get();
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('content.profile.list_follow', compact('follow', 'profile'));
    }

    public function all_user()
    {
        $admin = User::where('email', 'admin@skypost.com')->first();
        $user = User::all();
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('content.all_user', compact('admin', 'user', 'profile'));
    }
    
    public function remove($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/all_user');
    }
}
