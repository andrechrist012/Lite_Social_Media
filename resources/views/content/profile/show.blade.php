@extends('welcome')
@section('content')
  <section class="content">
    <section id="cover" class="container">
      <div class="jumbotron  mb-0 pb-2" style="background-color: white; display: flex; align-items: center; justify-content: space-around;">
        <div style="display: flex; flex-direction: column; align-items: center;">
          <img src="{{asset('image-upload/'.$user->thumbnail_url)}}" class="rounded-circle border" alt="..." width="200" height="200">
          <h3>{{$user->first_name}} {{$user->last_name}}</h3>
          <p>@<span>{{$user->user->username}}</span></p>
        </div>
        <div class="col-md-4 rounded  ml-3">
            <h3>Intro</h3>
            <hr class="border">
            <p><i class="fas fa-gift"></i>  {{$user->date_of_birth}}</p>
            <p><i class="fas fa-map-marker-alt"></i>  {{$user->address}}</p>
            <p><i class="fas fa-pencil-alt"></i> Bio: <br> {{$user->bio}}</p>
            <p>current user : {{Auth::id()}}</p>
          </div>
      </div>
      <div class="jumbotron my-0 py-0" style="background-color: rgb(59, 121, 172);">
        <div class="d-flex bd-highlight mb-3">
          <div class="p-2 bd-highlight">
            <a href="#"><p style="color: white;">{{$count}} Post</p></a>
          </div>
          <div class="p-2 bd-highlight">
            <a href="#"><p style="color: white;">{{$follow}} Follow</p></a>
          </div>
          <div class="p-2 bd-highlight">
            <a href="#"><p style="color: white;">{{$follower}} Followers</p></a>
          </div>
          <div class="ml-auto p-2 bd-highlight">
            @if ($user->user_id == Auth::id())
              <div class="ml-auto p-2 bd-highlight">
                <a href="/profile/{{Auth::id()}}/edit"><button type="button" class="btn btn-default" style="color: rgb(59, 121, 172);">Edit Profile</button></a>
              </div>
            @elseif ($getFollow == Auth::id())
              <form action="/follow/{{Auth::id()}}/" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-default" style="color: rgb(59, 121, 172);">Unfollow</button>
              </form>
            @elseif ($getFollow != Auth::id())
              <form action="/follow/{{$user->user_id}}/" method="POST">
                @csrf
                <button type="submit" class="btn btn-default" style="color: rgb(59, 121, 172);">Follow</button>
              </form>
            @endif
          </div>
        <div>
      </div>
    </section>
      <div class="container-fluid" style="padding: 2em; display: flex; flex-direction: column; justify-content: center; align-items: center;">
          @forelse ($post as $value)
          <div class="col-md-10" style="padding-bottom: .5em;">
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="{{asset('image-upload/'.$value->user->profile->thumbnail_url)}}" alt="User Image">
                  <span class="username"><a href="#">{{$value->user->profile->first_name}} {{$value->user->profile->last_name}}</span></a>
                  <span class="description">{{ date('F d, Y', strtotime($value->created_at)) }}</span>
                </div>
                @if ($value->user_id == Auth::id())
                  <form action="/post/{{$value->id}}" method="POST" style="float: right;">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Delete">
                  </form>
                  <a href="/post/{{$value->id}}/edit" class="btn btn-primary" style="float: right; margin-right:.5em;">Edit</a>
                @else
                  <div></div>
                @endif
              </div>
              <div>
                <div class="card-body">
                  @if ($value->image_url)
                    <img class="img-fluid pad" src="{{asset('image-upload/'.$value->image_url)}}" alt="Photo" style="width: 1000px; max-height: 1000px">
                  @else
                    <div></div>
                  @endif
                    <h1 style="text-transform: capitalize;">{{$value->title}}</h1>
                    <p>{{$value->description}}</p>
                    <form action="/like/{{$value->id}}/" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                      <span class="float-right text-muted">{{$value->like}} likes - {{$value->comment_amount}} comments</span>
                    </form>
                </div>
                <div class="card-footer card-comments" style="max-height: 300px; overflow: auto;">
                  @forelse ($comment as $val)
                    @if ($val->post_id == $value->id)
                    <div class="card-comment">
                      <img class="img-circle img-sm" src="{{asset('image-upload/'.$val->user->profile->thumbnail_url)}}" alt="User Image">
                      <div class="comment-text">
                          <span class="username">
                            {{$val->user->profile->first_name}} {{$val->user->profile->last_name}}
                            <span class="text-muted float-right">{{ date('F d, Y', strtotime($val->created_at)) }}</span>
                          </span>
                          {{$val->comment}}
                          @if ($val->user_id == Auth::id())
                            <form action="/comment/{{$val->id}}" method="POST" >
                              @csrf
                              @method('DELETE')
                              <input type="submit" class="btn" value="Delete" style="background-color: none; padding: 0; color: red; font-size: 14px;">
                            </form>
                          @else
                            <span></span>
                          @endif
                      </div>
                      <!-- /.comment-text -->
                    </div>
                    @else
                      <div></div>
                    @endif
                  @empty
                    <div></div>  
                  @endforelse   
                </div>
              </div>
              <div class="card-footer" style="background-color: rgb(59, 121, 172);">
                <form action="/comment/{{$value->id}}/" method="post">
                  @csrf
                  <img class="img-fluid img-circle img-sm" src="{{asset('image-upload/'.$profile->thumbnail_url)}}" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push" style="display: flex;">
                    <input type="text" class="form-control form-control-sm" name="comment" placeholder="Insert your comment here" required>
                    <button type="submit" class="btn btn-default btn-sm" style="margin-left: 1em;">Send</button>
                  </div>
                  <!-- <button type="submit" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button> -->
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          @empty
            <div>
                <h1>There's no post</h1>
            </div>  
          @endforelse   
      </div>
    </section>

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
@endsection