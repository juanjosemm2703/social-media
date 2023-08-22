@extends('layouts.master')
@section('title')
    Meda Media
@endsection
@section('content')

<section class="posts">
    <div class="post_form">
        <form>
        <label for="fname">User Name:</label><br>
        <input type="text" id="uname" name="uname" value="John"><br>
        <label for="lname">Post:</label><br>
        <textarea id="post" name="post" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Submit">
        </form>
    </div>
    <div class="post_list">
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>
        <div class="post_card">
        </div>    
        <div class="post_card">
        </div>
    </div>
</section>
@endsection