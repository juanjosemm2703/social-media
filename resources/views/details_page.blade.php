@extends('layouts.master')
@section('title')
    Users Meda Media
@endsection
@section('content')
    <section class="posts">
        <div class="post-form">
            <h2>Edit Post</h2>
            <form>
            <label for="postTitle">Post Title:</label><br>
            <input type="text" id="postTitle" name="postTitle" value="Recipe Share - Delicious Chocolate Cake"><br>
            <label for="post">Post:</label><br>
            <textarea id="post" name="post" rows="4" cols="50">Made this incredible chocolate cake over the weekend. It's super moist and chocolaty. Here's the recipe!</textarea><br>
            <input type="submit" value="Edit">
            </form>
        </div>
        <div class="post-list">
        <div class="post-card">
            <div class="post-card__title">
                <h2>Recipe Share - Delicious Chocolate Cake</h2>
            </div>
            <div class="post-card__message">
                <p>Made this incredible chocolate cake over the weekend. It's super moist and chocolaty. Here's the recipe!</p>
            </div>
            <div class="post-card__footer">
                <div class="users__card-footer">
                    <i class="fa-regular fa-comment fa-lg"></i>
                    <p>25</p>              
                </div>
                <div class="users__card-footer">
                        <button type="submit" form="form0" value="submit">
                            <i class="fa-regular fa-thumbs-up fa-lg"></i>
                        </button>
                    <p>10</p>              
                </div>
                <div class="users__card-footer">
                    <a href="#"> <i class="fa-solid fa-trash fa-lg"></i></i></a>             
                </div>
                <h4>@BakingEnthusiast</h4>
                <p class="post-card__footer-date">September 3, 2023</p>
            </div>
            <div class="post-form">
            <h2>New comment</h2>
            <form action="#" method="post" id="form0">
                <label for="fname">User Name:</label><br>
                <input type="text" id="uname" name="uname" placeholder="Your name..."><br>
                <label for="comment">Comment:</label><br>
                <input type="text" id="comment" name="comment" placeholder="Write a comment..."><br>
                <input type="submit" value="Submit">
            </form>
            </div>
            <div class="post-card__comments">
                <p class = "comment_reply">This is a comment</p>
                <div class="post-card__comments-footer">
                    <form action="reply/1" method="post" id="form1">
                        <input type="text" id="comment" name="comment" placeholder="Write a comment..."><br>
                    </form>
                    <button type="submit" form="form1" value="submit">
                        <i class="fa-regular fa-paper-plane fa-lg"></i>
                    </button>
                </div> 
                <a class="hide"> Show replies...</a>
                
                <div class="reply hidden">
                    <p class = "comment_reply">This is a comment</p>
                    <div class="post-card__comments-footer">
                        <form  action="#" method="get" id="form1">
                            <input type="text" id="comment" name="comment" placeholder="Write a comment..."><br>
                        </form>
                        <button type="submit" form="form1" value="submit">
                                <i class="fa fa-arrow-circle-right fa-lg"></i> 
                        </button>
                    </div> 
                    <a class="hide"> Show replies...</a>
                </div>
            
            </div>
           
        </div>
        </div>
    </section>
@endsection