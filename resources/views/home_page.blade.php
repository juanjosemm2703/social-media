@extends('layouts.master')
@section('title')
    Meda Media
@endsection
@section('content')

<section class="posts">
    <div class="post_form">
        <form>
        <label for="fname">User Name:</label><br>
        <input type="text" id="uname" name="uname" placeholder="Your name..."><br>
        <label for="fname">Post Title:</label><br>
        <input type="text" id="uname" name="uname" placeholder="Insert the post title..."><br>
        <label for="lname">Post:</label><br>
        <textarea id="post" name="post" rows="4" cols="50" placeholder="Start typing your post here..."></textarea><br>
        <input type="submit" value="Submit">
        </form>
    </div>
    <div class="post_list">
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
        <div class="post_card">
            <div class="post__card--title">
                <a href="#"><h2>Recipe Share - Delicious Chocolate Cake</h2></a>
                <i class="fa-regular fa-comment fa-lg"></i>
                <p>25</p>
            </div>
            <div class="post__card--footer">
                <h4>BakingEnthusiast</h4>
                <p class="date">September 3, 2023</p>
            </div>
        </div>
    </div>
</section>
@endsection