@extends('layouts.master')
@section('title')
    PostHub - Home
@endsection
@section('content')

<section class="posts">
    <div class="post-form">
        <h2>New Post</h2>
        <form method="post" action="{{url("new_post_action")}}">
            @csrf
            <label for="uname">User Name:</label><br>         
            <input type="text" id="uname" name="uname" placeholder="Your name..." 
            @if($data['userName'] !== "")
                value="{{$data['userName']}}"
                readonly
            @endif
            ><br>
            <label for="postTitle">Post Title:</label><br>
            <input type="text" id="postTitle" name="postTitle" placeholder="Insert the post title..."><br>
            <label for="post">Post:</label><br>
            <textarea id="post" name="post" rows="4" cols="50" placeholder="Start typing your post here..."></textarea><br>
            <input type="submit" value="Submit">
        </form>
        @isset($data['errors'])
            @foreach ($data['errors'] as $error)
                <div class="error">{{$error}}</div>
            @endforeach
        @endisset
    </div>
    <div class="post-list">
        @foreach($posts as $post)
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/$post->post_id")}}"><h2>{{$post->title}}</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>{{$post->comment_count}}</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@ {{$post->author}}</h4>
                <p class="post-card__footer-date">{{date_format(date_create($post->date),"F d, Y")}}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection