@extends('welcome')
@section('content')
<div style="padding: 2em;">
    <div style="
        background-color: white;
        padding: 2em;
        border-radius: 2em;
    ">
        <p style="font-weight: bold; font-size: 40px; color: rgb(59, 121, 172);">Create Post</p>
        <form action="/all_post" method="POST" enctype="multipart/form-data" style="color: rgb(59, 121, 172);">
            @csrf
            <div style="display: flex; flex-direction: row;">
                <div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" value="" id="title">
                        @error('title')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label><br>
                        <textarea name="description" id="description" value="" cols="50" rows="10"></textarea>
                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="/all_post" class="btn btn-info">Back</a>
                </div>
                <div style="padding-left: 5em;">
                    <label for="image">Post Image</label><br>
                    <input type="file" name="image_url" id="image_url">
                    @error('image_url')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div id="preview" class="preview">
                        <img src="" alt="preview" class="img_preview">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
