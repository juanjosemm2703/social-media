@extends('layouts.master')
@section('title')
    Meda Media
@endsection
@section('content')

<section class="posts">
    <div class="post-form">
        <h2>New Post</h2>
        <form method="post" action="/">
            @csrf
            <label for="uname">User Name:</label><br>
            <input type="text" id="uname" name="uname" placeholder="Your name..."><br>
            <label for="postTitle">Post Title:</label><br>
            <input type="text" id="postTitle" name="postTitle" placeholder="Insert the post title..."><br>
            <label for="post">Post:</label><br>
            <textarea id="post" name="post" rows="4" cols="50" placeholder="Start typing your post here..."></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <div class="post-list">
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        <div class="post-card">
            <div class="post-card__title">
                <a href="{{url("post/1")}}"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>
                </div>
            </div>
            <div class="post-card__footer">
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
        </div>
        
    </div>
</section>
@endsection