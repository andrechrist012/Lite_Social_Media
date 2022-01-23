@extends('welcome')
@section('content')
<div style="padding: 2em;">
    <div style="
        background-color: white;
        padding: 2em;
        border-radius: 2em;
    ">
        <p style="font-weight: bold; font-size: 40px; color: rgb(59, 121, 172);">Profile Settings</p>
        <form action="/profile/{{$profile->id}}" method="POST" enctype="multipart/form-data" style="color: rgb(59, 121, 172);">
            @csrf
            @method('put')
            <div>
                <div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{$profile->first_name}}" id="first_name">
                        @error('first-name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label><br>
                        <input type="text"  name="last_name" class="form-control" value="{{$profile->last_name}}" placeholder="lastname" >
                        @error('last_name')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text"  name="address" class="form-control" placeholder="enter address" value="{{$profile->address}}">
                        @error('address')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of birth</label>
                        <input type="text"  name="date_of_birth" class="form-control" placeholder="enter date of birth" value="{{$profile->date_of_birth}}">
                        @error('date_of_birth')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio" cols="20" rows="5" class="form-control" placeholder="bio">{{$profile->bio}}</textarea>
                        @error('bio')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="thumbnail_url">Photo Profile</label><br>
                        <input type="file" name="thumbnail_url" id="thumbnail_url">
                        @error('thumbnail_url')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div><br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/profile" class="btn btn-info">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
