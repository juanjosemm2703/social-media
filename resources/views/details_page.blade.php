@extends('layouts.master')
@section('title')
    Users Meda Media
@endsection
@section('content')

    <section class="posts">
      
        <div class="post-form">
            <h2>Edit Post</h2>
            <form method="post" action="{{url("edit_post_action")}}">
                @csrf
                <input type="hidden" name="post_id" value="{{$post->post_id}}">
                <label for="postTitle">Post Title:</label><br>
                <input type="text" id="postTitle" name="postTitle" value="{{$post->title}}"><br>
                <label for="post">Post:</label><br>
                <textarea id="post" name="post" rows="4" cols="50">{{$post->message}}</textarea><br>
                <input type="submit" value="Edit">
            </form>
            @isset($data['errors'])
                @foreach ($data['errors'] as $error)
                    <div class="error">{{$error}}</div>
                @endforeach
            @endisset
        </div>
        <div class="post-list">
        <div class="post-card">
            <div class="post-card__title">
                <h2>{{$post->title}}</h2>
            </div>
            <div class="post-card__message">
                <p>{{$post->message}}</p>
            </div>
            <div class="post-card__footer">
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>{{$post->comment_count}}</p>              
                </div>
                <div class="users__card-footer">      
                    @if($data['userName'] == "")
                        <i class="fa-regular fa-thumbs-up fa-lg"></i>
                    @else
                        <a href="{{url("like/$post->post_id")}}">
                        <i class="
                        @if($post->user_liked == 1)
                            fa-solid 
                        @else 
                            fa-regular 
                        @endif 
                        fa-thumbs-up fa-lg"></i>
                        </a>
                    @endif    
                    <p>{{$post->likes}}</p>              
                </div>
                <div class="users__card-footer">
                <a href="{{url("delete_post/$post->post_id")}}"> 
                        <i class="fa-solid fa-trash fa-lg"></i>
                    </a>             
                </div>
                <h4>@ {{$post->author}}</h4>
                <p class="post-card__footer-date">{{date_format(date_create($post->date),"F d, Y")}}</p>
            </div>
            <div class="post-form">
                <h2>New comment</h2>
                <form action="{{url("new_comment_action")}}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->post_id}}">
                    <label for="fname">User Name:</label><br>
                    <input type="text" id="uname" name="uname" placeholder="Your name..." 
                    @if($data['userName'] !== "")
                        value="{{$data['userName']}}"
                        readonly
                    @endif
                    ><br>
                    <label for="message">Comment:</label><br>
                    <input type="text" id="message" name="message" placeholder="Write a comment..."><br>
                    <input type="submit" value="Submit">
                </form>    
            </div>
            @include('layouts.commentTemplate', ['comments' => $comments])
            </div>
           
        </div>
        </div>
    </section>
@endsection