@extends('layouts.master')
@section('title')
    Users Meda Media
@endsection
@section('content')
    <section class="users">
        <h1>Users</h1>
        <div class="users__grid">
            <a href="{{url("user/1")}}">
            <div class="users__card">
                <h2>Juan Martinez</h2>
                <div class="users__card-footer">
                        <i class="fa-regular fa-message"></i>
                        <p>32 posts</p>`
                </div>
            </div>
            </a>
        </div>
    <section>
@endsection