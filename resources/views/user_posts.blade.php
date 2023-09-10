@extends('layouts.master')
@section('title')
    PostHub - Users
@endsection
@section('content')
<section class="posts">
        <div class="post-list">
        @foreach($posts as $post)
            <div class="post-card">
                <div class="post-card__title">
                    <a href="{{url("post/$post->post_id")}}"><h2>{{$post->title}}</h2></a>
                </div>
                <div class="post-card__message">
                    <p>{{$post->message}}</p>
                </div>
                <div class="post-card__footer">
                    <div class="users__card-footer">
                        <i class="fa-regular fa-comment fa-lg"></i>
                        <p>{{$post->comment_count}}</p>              
                    </div>
                    <h4>@ {{$post->author}}</h4>
                    <p class="post-card__footer-date">{{date_format(date_create($post->date),"F d, Y")}}</p>
                </div>         
            </div>
        @endforeach
        </div>
    </section>
@endsection